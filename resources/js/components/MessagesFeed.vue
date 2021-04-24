<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div class="text">
                    {{ message.message }}
                </div><br>

                <span style="font-size:10px; position: relative; top: -2px;">
                    {{ message.created_at | msgTime }}
                </span>

            </li>
        </ul>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {

        beforeMount() {
            Vue.filter('msgTime', function(value){
                return moment(value).utc(+0).fromNow();
            })
        },

        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    };
</script>

<style lang="scss" scoped>
.feed {
    background: #f0f0f0;
    height: 100%;
    max-height: 470px;
    overflow: scroll;
    margin-left: -13px !important;
    ul {
        list-style-type: none;
        padding: 5px;
        li {
            &.message {
                margin: 10px 0;
                width: 100%;
                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }
                &.received {
                    text-align: right;
                    .text {
                        background: #b2b2b2;
                        color: #fff;
                    }
                }
                &.sent {
                    text-align: left;
                    .text {
                        background: #81c4f9;
                        color: #222;
                    }
                }
            }
        }
    }
}
</style>