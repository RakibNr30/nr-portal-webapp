<template>
    <div class="text-center mt-4 mb-4">
        <h4 style="margin-bottom: 10px;">Send a message</h4>
        <textarea id="textarea" v-model="message" @keydown.enter="send" class="form-control" maxlength="225" rows="1" placeholder="Type your message..."></textarea>
        <br>
        <button v-model="message" @click="send" class="btn btn-outline-success waves-effect waves-light col-md-offset-2"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
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