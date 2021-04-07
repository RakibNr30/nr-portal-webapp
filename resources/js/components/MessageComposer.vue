<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="Type your message..."></textarea>
        <button v-model="message" @click="send" style="bottom: 50px;" class="btn btn-secondary waves-effect mt-4"><i class="mdi mdi-reply"></i> Send</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        methods: {
            send(e) {
                e.preventDefault();
                
                if (this.message == '') {
                    return;
                }
                this.$emit('send', this.message);
                this.message = '';
            }
        }
    };
</script>

<style lang="scss" scoped>
.composer textarea {
    width: 87%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
    outline: none;
    margin-left: -10px !important;
}
</style>