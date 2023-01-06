<template>
    <li><span style="color: #FFFFFF;" class="unselectable" :class="{'boxHovered': boxHovered}" ref="coloredText" @click="scrollToView" @mouseleave="onTextUnhover()"
              @mouseenter="onTextHover()"><slot></slot></span></li>
</template>

<script>
export default {
    name: "HeaderItem.vue",

    props: {
        id: {
            type: String,
            required: true,
        }
    },

    data()
    {
        return {
            actualColor: '',
            boxHovered: false,
        }
    },

    mounted()
    {
        this.actualColor = this.$refs.coloredText.style.color;
    },
    methods:
        {
            scrollToView()
            {
                document.getElementById(this.id).scrollIntoView({behavior: "smooth"});
            },
            LightenDarkenColor(col,amt) {
                let usePound = false;
                if ( col[0] === "#" ) {
                    col = col.slice(1);
                    usePound = true;
                }

                let num = parseInt(col,16);

                let r = (num >> 16) + amt;

                if ( r > 255 ) r = 255;
                else if  (r < 0) r = 0;

                let b = ((num >> 8) & 0x00FF) + amt;

                if ( b > 255 ) b = 255;
                else if  (b < 0) b = 0;

                let g = (num & 0x0000FF) + amt;

                if ( g > 255 ) g = 255;
                else if  ( g < 0 ) g = 0;

                return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);
            },
            onTextHover()
            {
                this.boxHovered = true;
                console.log("#" + this.LightenDarkenColor(this.actualColor, 175));
                this.$refs.coloredText.style.color = "#" + this.LightenDarkenColor(this.actualColor, 175);
            },
            onTextUnhover()
            {
                this.boxHovered = false;
                this.$refs.coloredText.style.color = this.actualColor;
            }
        }
}
</script>

<style scoped>

.ulStyle > li
{
    display: inline-block;
}

.ulStyle > li > span
{
    margin-left: 15px;
    margin-right: 15px;
    padding: 20px 0px;
    font-size: 15px;
    display: inline-block;
    text-decoration: none !important;
    position: relative;
    cursor: pointer;
}

.boxHovered
{
    border-bottom: 1px solid #afafaf;
}

.unselectable
{
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;

    /*
      Introduced in Internet Explorer 10.
      See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
    */
    -ms-user-select: none;
    user-select: none;
}
</style>
