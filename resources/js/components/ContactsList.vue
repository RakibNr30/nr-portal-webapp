<template>
    <div class="contacts-list">
        <ul>
            <li style="cursor:default;">
                <div id="searchBox" class="mobile-form">
                    <p>Search User</p>
                    <form action="javascript:void(0);" class="search-form" id="searchform">
                        
                        <span id="noEasy">
                            <!-- <input class="sb-search-submit" type="submit"> -->
                            <span class="sb-icon-search" style="cursor:default;"></span>
                        </span>

                        <input id="sbox" @keyup="searchit" v-model="search" onblur="if (this.placeholder == '') {this.placeholder = 'Type to search';}" onfocus="if (this.placeholder == 'Type to search') {this.placeholder = '';}" placeholder="Type to search" type="search" x-webkit-speech="">
                    </form>
                </div>
            </li>

            <span v-if="dataContacts == 'no'">
                <li style="border-bottom:0px; cursor:default;">
                    <i class="fa fa-user-times" style="margin-left: 130px;font-size: 35px;margin-top: 7px;"></i>
                    <p style="margin-top: 50px;margin-left: -170px;text-align: center;"><b style="font-weight:550px; color:#666;">No Matching Result !</b>
                    Make sure you typed the user firstname, lastname correctly.</p>
                </li>
            </span>

            <span v-else-if="!dataContacts.length">
                <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
                    <div class="avatar">
                        <img :src="'http://via.placeholder.com/150'" :alt="contact.name">
                    </div>
                    <div class="contact">
                        <p class="name" style="font-size:14px !important;">{{ contact.first_name }}</p>
                        <!-- <p class="email" style="font-size:12px !important;;">{{ contact.email }}</p> -->
                    </div>
                    <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
                </li>
            </span>

            <span v-else>
                <li v-for="contact in dataContacts" v-if="contact != null" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
                    <div class="avatar">
                        <img :src="'http://via.placeholder.com/150'" :alt="contact.name">
                    </div>
                    <div class="contact">
                        <p class="name" style="font-size:14px !important;">{{ contact.first_name }}</p>
                        <!-- <p class="email" style="font-size:12px !important;;">{{ contact.email }}</p> -->
                    </div>
                    <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
                </li>
            </span>

        </ul>
    </div>
</template>

<script>
    export default {
        created() {
            Fire.$on('searching',() => {
                let query = this.search;
                axios.get('api/find/user?q=' + query)
                .then((data) => {
                    this.dataContacts = data.data
                    console.log(this.dataContacts)
                })
                .catch(() => {
                    
                })
            })
        },

        props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null,
                search: '',
                dataContacts: this.contacts,
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
            },

            searchit: _.debounce(() => {
                    Fire.$emit('searching');
                }, 250)
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }
                    return contact.unread;
                }]).reverse();
            }
        }
    };
</script>

<style lang="scss" scoped>
.contacts-list {
    flex: 2;
    max-height: 100%;
    height: 600px;
    overflow: scroll;
    border-left: 1px solid #ccc;
    margin-top: -20px;
    margin-right: -20px;
    border-bottom: 1px solid #ddd;
    
    ul {
        list-style-type: none;
        padding-left: 0;
        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #ddd;
            height: 80px;
            position: relative;
            cursor: pointer;
            
            &.selected {
                background: #dfdfdf;
            }

            span.unread {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }

            .search {

            }

            .avatar {
                flex: 1;
                display: flex;
                align-items: center;
                img {
                    width: 35px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }

            .contact {
                flex: 3;
                font-size: 10px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                p {
                    margin: 0;
                    &.name {
                        font-weight: bold;
                    }
                }
            }

        }
    }
}

div#searchBox {
    float: none;
    text-align: center;
    color: #777;
    margin-top: 3px;
}

#searchform {
    border-bottom: 1px solid #ccc;
    padding: 8px 0 0;
}

#searchform input {
    border: 0px;
    background: transparent;
    padding: 8px 10px 5px;
    outline: none;
}

.mobile-form #searchform {
    padding-top: 2.5px;
    width: 215px;
}

div#searchBox #searchform {
    border: 1px solid #ddd;
    width: 290px;
    padding-top: 1px;
    display: inline-block;
    margin-left: 6px;
}

div#searchBox #searchform input {
    padding: 5px;
    display: block;
}

#searchBox i.fa.fa-search {
    padding: 8px;
    cursor: pointer;
}

.sb-icon-search,
.sb-search-submit {
    width: 30px;
    height: 30px;
    display: block;
    position: absolute;
    right: 0;
    top: 0;
    padding: 0;
    margin: 0;
    line-height: 30px;
    text-align: center;
    cursor: pointer;
}

.sb-search-submit {
    background: #fff;
    /* IE needs this */
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    /* IE 8 */
    filter: alpha(opacity=0);
    /* IE 5-7 */
    opacity: 0;
    color: transparent;
    border: none;
    outline: none;
    z-index: 100;
}

div#searchBox #searchform .sb-icon-search {
    /* color: #fff; */
    /* background: #3f91c3; */
    z-index: 90;
    /* font-size: 22px; */
    font-family: 'FontAwesome';
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    -webkit-font-smoothing: antialiased;
    top: -1px;
}

div#searchBox #searchform .sb-icon-search:before {
    content: "\f002";
}

span#noEasy {
    display: block;
    /* overflow: hidden; */
    position: relative;
    width: 30px;
    height: 30px;
    float: left;
    padding-left: 3px;
}

span#noEasy input {
    width: 30px;
    padding: 0 !important;
}

input#sbox {
    line-height: 31px;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}
span#noEasy:hover {
    color: #444;
}
</style>