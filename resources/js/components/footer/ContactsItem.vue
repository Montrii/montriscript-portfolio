<template>
    <li class="listItem">
        <div class="iconCircle" ref="circle"
             @mouseleave="buttonHovered = false"
             @mouseenter="buttonHovered = true"
             :class="{'buttonHovered' : buttonHovered}">
            <slot></slot>
        </div>
    </li>
</template>

<script>
export default {
    name: "ContactsItem.vue",


    data()
    {
        return {
            buttonHovered: false
        }
    },
    props:
        {
            color: {
                type: String,
                required: true,
            }
        },

    mounted()
    {

        // linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
        if(this.color === 'instagram')
        {
            this.$refs.circle.style.background = 'linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d)';
        }
        else
            this.$refs.circle.style.backgroundColor = this.color;

    }
}
</script>

<style scoped>

.buttonHovered
{
    box-shadow: inset 0 0 0 10em rgba(255, 255, 255, 0.3);
}
.listItem
{

    width: 32px;
    height: 32px;
    max-width: 246px;
    display: list-item;
    margin-right: 16px!important;
    margin-left: 16px!important;
}


.iconStyle
{
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.iconCircle
{
    border-radius: 100%;
    height: 100%;
    color: white;
    position: relative;
    cursor: pointer;
}
</style>
