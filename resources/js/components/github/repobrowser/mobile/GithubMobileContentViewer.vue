<template>
    <div class="w-full h-full relative">
        <!-- header row for current file and close button -->
        <div class="w-full h-10" style="border-bottom: 1px solid rgb(52, 52, 52);">
            <!-- file header --->
            <GithubFileHeader :currentFile="this.currentFile" @fileClosed="setFileClose()"></GithubFileHeader>

            <!-- exit button --->
            <div class="h-full mr-5" style="float: right; display: inline-block">
                <font-awesome-icon class="pr-5 pt-1" icon="fa-solid fa-xmark"/>
            </div>
        </div>


        <!-- file content --->
        <div class="w-full relative" style="height: 95%;">
            <!-- amount of lines displayed -->
            <div style="width: 12.5%;" class="relative editortheme linesWrapper"
                 ref="lineNumber">
                <div v-for="index in this.fileLines">
                    <p class="lineDesign">{{index}}</p>
                </div>
            </div>


            <!-- textarea content -->
            <div style="right: 0px; position: absolute; width: 87.5%; height: 100%;">
                <div class="backdrop editortheme" style="font-size: 12px;" ref="clonedTextArea">
                    <div class="custom-area">
                        <!-- TODO - make sure html code does not get rendered --->
                        <!-- cloned text goes here --->
                        <span>{{this.clonedText}}</span>
                    </div>
                </div>
                <textarea class="textarea-style editortheme" v-model="realText" @input="fileContentChanged" @scroll="textAreaScroll" readonly></textarea>
            </div>


        </div>
    </div>
</template>

<script>
import GithubFileIcon from "@/components/github/repobrowser/utilties/GithubFileIcon.vue";
import GithubFileHeader from "@/components/github/repobrowser/utilties/GithubFileHeader.vue";
export default {
    name: "GithubMobileContentViewer.vue",
    components: {
        GithubFileHeader,
        GithubFileIcon
    },
    data()
    {
        return {
            realText: '',
            clonedText: '',
            fileLines: 0,
        }
    },
    props: {
        currentFile: {
            type: Object,
            required: true
        }
    },
    methods:
        {
            fileContentChanged()
            {
                let currentFilesLines = this.realText.split(/\r\n|\r|\n/).length;
                if(this.fileLines !== currentFilesLines)
                {
                    this.fileLines = currentFilesLines;
                }

                // this.clonedText = this.realText;
                this.applySyntaxHighlighting(this.realText);

            },
            textAreaScroll(e)
            {
                this.$refs.lineNumber.scrollTo(0, this.$refs.clonedTextArea.scrollTop);
                this.$refs.clonedTextArea.scrollTo(0, e.target.scrollTop);
            },
            setFileClose()
            {
                this.$emit("fileClosed");
            },
            applySyntaxHighlighting(text)
            {
                // TODO - syntax highlighting missing
                let eachLine = text.split("\n");
                this.clonedText = eachLine.join('\n');
            }
        },

    mounted()
    {
        String.prototype.includesAll = function(all)
        {
            return all.every(item => this.includes(item));
        }


        this.realText = atob(this.currentFile.content);
        this.fileContentChanged();
    }
}
</script>

<style scoped>
.editortheme
{
    font-family: MonoLisa, Menlo, Monaco, "Courier New", monospace;
    font-weight: normal;
    font-size: 15px;
    line-height: 24px;
    letter-spacing: 0px;
}
.textarea-style
{
    margin: 0;
    position: absolute;
    border-radius: 0;
    background-color: transparent;
    color: transparent;
    z-index: 2;
    resize: none;

    width: 100%;
    height: 100%;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;

    border: none;
    outline: none;
    caret-color: rgb(52, 52, 52);
}

.backdrop
{
    position: absolute;
    z-index: 1;
    overflow: auto;
    overflow-y:hidden;
    pointer-events: none;
    height: 100%;
    width: 100%;

}

.custom-area
{
    white-space: pre-wrap;
    word-wrap: break-word;
}



/* SCROLLBAR STYLES */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    background: transparent;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: rgb(52, 52, 52);
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}


/* SELECT TEXT STYLE */
::selection {
    color: white;
    background-color: rgba(28, 46, 62, 1);
}

.linesWrapper
{
    pointer-events:none;
    width: 5%;
    border-right: 1px solid rgb(52, 52, 52);
    float: left;
    height: 100%;
    overflow: auto;
    overflow-y: hidden;
}

.lineDesign
{
    text-align: center;
    vertical-align: middle;
}

.height-95
{
    height: 95%;
}
</style>
