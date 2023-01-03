<template>
    <div class="h-full" style="width: 87.5%; float: left; border-right-color: rgb(52, 52, 52)">

        <!-- files header -->
        <div class="w-full h-5 filesheader">
            <!-- this is where the file that is opened will be displayed -->
            <div draggable="true" class="h-full currentSelectedFile">
                <GithubFileIcon :extension="this.extension"></GithubFileIcon>
                <span class="font-bold">{{ this.currentFile.name }}</span>
                <font-awesome-icon class="currentFileCancel" icon="fa-solid fa-xmark" @click="setFileClose()" />
            </div>

        </div>
        <div class="w-full height-95">
            <!-- amount of lines displayed -->
            <div class="relative editortheme linesWrapper"
            ref="lineNumber">
                <div v-for="index in this.fileLines">
                    <p class="lineDesign">{{index}}</p>
                </div>
            </div>

            <!-- actual file display --->
            <div class="h-full relative fileContentWrapper">
                <div class="backdrop editortheme" ref="clonedTextArea">
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
export default {
    name: "GithubRepoContentViewer",

    data()
    {
        return {
            realText: '',
            clonedText: '',
            fileLines: 0,
            extension: '',

        }
    },
    components: {
        GithubFileIcon
    },

    methods: {
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

    props: {
        currentFile: {
            type: Object,
            required: true
        }
    },
    mounted()
    {
        String.prototype.includesAll = function(all)
        {
            return all.every(item => this.includes(item));
        }


        this.extension = this.currentFile.name.split('.')[1];
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



.height-95
{
    height: 95%;
}
.filesheader
{
    min-height: 30px; padding-left: 12px; padding-right: 12px; border-bottom: 1px solid rgb(52, 52, 52);
    border-top-color: rgb(52, 52, 52);
    border-right-color: rgb(52, 52, 52);
    border-left-color: rgb(52, 52, 52);
    padding-top: 3px
}

.currentSelectedFile
{
    width: 15%;
    border-right: 1px solid rgb(52, 52, 52);
    background-color: rgb(21, 21, 21);
    --tab-border-bottom-color:#6cc7f6;
    color: white; font-style: italic; font-size: 12px; padding-top: 2px;
}

.currentFileCancel
{
    float: right;
    padding-top: 2px;
    padding-right: 16px;
    cursor: pointer;
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
    margin: 0;
    padding: 0;
    text-align: center;
    padding-right: 8px;
}

.fileContentWrapper
{
    width: 95%;
    border-right-color: rgb(52, 52, 52);
    float: left;
}
/* main attributes: 3E8ED5, comments: 4F8B4C, return, if, try: D893b1, parameters: 94D9F7*/
</style>
