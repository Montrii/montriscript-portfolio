<template>
    <div class="h-full" style="width: 87.5%; float: left; border-right-color: rgb(52, 52, 52)">

        <!-- files header -->
        <div class="w-full h-5" style="min-height: 30px; padding-left: 12px; padding-right: 12px; border-bottom: 1px solid rgb(52, 52, 52);
                border-top-color: rgb(52, 52, 52);
                border-right-color: rgb(52, 52, 52);
                border-left-color: rgb(52, 52, 52);
                padding-top: 3px">
            <!-- this is where the file that is opened will be displayed -->

        </div>
        <div class="w-full" style="height: 95%">
            <!-- amount of lines displayed -->
            <div class="relative editortheme" style="pointer-events:none; width: 5%; border-right: 1px solid rgb(52, 52, 52); float: left; height: 100%; overflow: auto; overflow-y: hidden;"
            ref="lineNumber">
                <div v-for="index in this.fileLines">
                    <p style="margin: 0; padding: 0; text-align: center; padding-right: 8px;">{{index}}</p>
                </div>
            </div>

            <!-- actual file display --->
            <div class="h-full relative" style="width: 95%; border-right-color: rgb(52, 52, 52); float: left;">
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
export default {
    name: "GithubRepoContentViewer",

    data()
    {
        return {
            realText: '',
            clonedText: '',
            fileLines: 0,
            colorMap: {"apple": "red", "market": "green", "banana": "orange", "select": "orange", "private": "#3E8ED5", "void": "#3E8ED5", "public": "#3E8ED5",
                "protected": "#3E8ED5", "{": "white", "}": "white", ";": "white", "return": "purple"},

        }
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

/* main attributes: 3E8ED5, comments: 4F8B4C, return, if, try: D893b1, parameters: 94D9F7*/
</style>
