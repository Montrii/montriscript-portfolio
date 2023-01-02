<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Exception;
use GrahamCampbell\GitHub\Facades\GitHub;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use InvalidArgumentException;

class GithubController extends Controller
{
    //

    /**
     * @throws GuzzleException
     */
    // Recursive Function to get all files from a repository
    public function getRepositoryFiles($repository, Request $request)
    {

        $collection = collect([]);

        Log::info('getRepositoryFiles: ' . $repository);
        try
        {
            GitHub::repo()->show(env("GITHUB_NAME"), $repository);
            $client = new Client();
            $collection = Cache::remember("repository - " . $repository, 60 * 60, function() use ($repository, $client) {
                return $this->getAllRepositoryFiles($client,'https://api.github.com/repos/' . env("GITHUB_NAME") . '/' . $repository . '/contents', collect([]));
            });

        }
        catch(Exception $error)
        {
            Log::error($error);
            $collection = collect(["error" => "Repository not found."]);
        }

        return ["repositoryFiles" => $collection];

    }


    private function stringInsert($str, $inserter, $pos): string
    {
        $string = substr($str, 0, $pos) . $inserter . substr($str, $pos);
        return $string;
    }
    public function getAllRepositoryFiles($client, $url, Collection $collection): Collection
    {
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'token ' . env('GITHUB_TOKEN'),
            ]
        ]);


        $json = $response->getBody()->getContents();
        // if json is not in an array, put it in an array (for files with content in it, as GitHub API returns them as object, not as array[0]
        if(!Str::contains($json, ["[", "]"]))
        {

            try
            {
                $json = $this->stringInsert($json, "[", 0);
                $json = $this->stringInsert($json, "]", strlen($json));
                $json = json_decode($json);

                $collection->push([
                    'name' => $json[0]->name,
                    'path' => $json[0]->path,
                    'type' => "file",
                    'content' => $json[0]->content,
                    'size' => $json[0]->size,
                    'encoding' => $json[0]->encoding,
                ]);
            }
            catch(InvalidArgumentException $e)
            {
                Log::info($e);
            }
        }
        else
        {
            $json = json_decode($json);

            // use collections to filter json
            $json = collect($json);

            $json = $json->filter(function($item) {
                return !Str::contains($item->path, [
                    ".vsidx", ".lock", ".csproj", ".resx", ".application", ".exe", ".pdb", ".cache", ".manifest", ".deploy", ".suo",
                    "/lib/", "/lib", "lib/", ".dll", ".asi", ".sf", ".mp3", ".mp4", ".wma", ".aac", ".ttf", ".sln", ".pfx", ".resources", ".inf", "/node_modules/", "/.idea/",
                    "node_modules/", ".idea/", ".env", "Procfile",
                ]);
            });

            $json = json_decode($json);
            foreach($json as $file)
            {
                if($file->type === "file" && !isset($file->content))
                {
                    $this->getAllRepositoryFiles($client, $file->url, $collection);
                }
                else if($file->type === "dir")
                {
                    $collection->push([
                        'name' => $file->name,
                        'path' => $file->path,
                        'type' => "dir",
                        'content' => null,
                        'size' => null,
                        'encoding' => null,
                    ]);
                    $this->getAllRepositoryFiles($client, $file->url, $collection);
                }
            }
        }
        return $collection;
    }

    public function loadGithubRepositories()
    {

        $repositories = collect(GitHub::me()->repositories())->map(function($item, $index)
        {
            $project = null;
            if(Cache::has('projects'))
            {
                $projects = Cache::get('projects');
                $project = $projects->where('title', $item['name'])->first();
                return ['githubRepo' => $item, 'onlineStatus' => $project];
            }
            else
            {
                $projects = Projects::all();
                Cache::put('projects', $projects, now()->addMinutes(60));
                $project = $projects->where('title', $item['name'])->first();
                return ['githubRepo' => $item, 'onlineStatus' => $project];
            }
        });
        return response()->json($repositories);
    }
}
