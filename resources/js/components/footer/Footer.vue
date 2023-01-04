<template>
    <!-- footer outer content --->
    <div style="position: absolute; width: 100%; height: 15%; bottom: 0; justify-content: center; display: flex;" class="text-center">
        <div style="position: relative; width: 95%; height: 100%; border-top: 1px solid rgb(52, 52, 52);">
            <div class="text-center pt-2" style="position: relative; height: 100%; width: 100%;">
                <!-- icons -->
                <ul class="layout">
                    <ContactsItem color="#FF0000">
                        <font-awesome-icon icon="fa-brands fa-youtube" class="iconStyle"
                         />
                    </ContactsItem>

                    <ContactsItem color="#1DA1F2">
                        <font-awesome-icon
                             icon="fa-brands fa-twitter" class="iconStyle" />
                    </ContactsItem>

                    <ContactsItem color="instagram">
                        <font-awesome-icon
                             icon="fa-brands fa-instagram" class="iconStyle" />
                    </ContactsItem>

                    <ContactsItem color="#0077B5">
                        <font-awesome-icon
                             icon="fa-brands fa-linkedin" class="iconStyle" />
                    </ContactsItem>

                    <ContactsItem color="#7289da">
                        <font-awesome-icon
                             icon="fa-brands fa-discord" class="iconStyle" />
                    </ContactsItem>

                    <ContactsItem color="#c28e00" >
                        <font-awesome-icon
                             icon="fa-solid fa-envelope" class="iconStyle" />
                    </ContactsItem>

                    <ContactsItem color="#00b22d">
                        <font-awesome-icon
                             icon="fa-brands fa-fonticons" class="iconStyle" />
                    </ContactsItem>
                </ul>

                <!-- title --->
                <h2 class="text-white pt-2" style="font-size: 22px;">Justin Green</h2>

                <!-- copyright reserved --->
                <div style="color: #605E5D; font-size: 9px; padding-top: 4px;">
                    <p>© Copyright 2022-2023</p>
                    <p>All rights reserved. Powered by
                        <ColoredLink color="#F05340">
                            Laravel
                        </ColoredLink>
                        ,
                        <ColoredLink color="#41B883">
                            Vue.JS
                        </ColoredLink>
                        and
                        <ColoredLink color="#674CC4">
                            Hostinger
                        </ColoredLink>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import ContactsItem from "@/components/footer/ContactsItem.vue";
import ColoredLink from "@/components/utilties/ColoredLink.vue";
export default {
    name: "Footer.vu",
    components: {ColoredLink, ContactsItem}
}
</script>

<style scoped>

.layout
{
    width: 100%;
    list-style-type: none;
    padding-left: 0;
    justify-content: center;
    display: flex;
    flex-wrap: wrap;
}

.iconStyle
{
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
