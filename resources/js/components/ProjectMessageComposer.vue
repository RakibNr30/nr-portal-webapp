<template>
    <div class="text-center mt-4">
        <h6 style="margin-bottom: 10px;">Stuur een bericht</h6>
        <div class="row">
            <div class="col-sm-9">
                <textarea id="textarea" v-model="message" @keydown.enter="send" class="form-control mt-2" maxlength="225" rows="1" placeholder="Schrijf je bericht...">
                </textarea>
            </div>
            <div class="col-sm-3">
                <button v-model="message" @click="send" class="btn btn-block btn-outline-success waves-effect waves-light mt-2">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    Sturen
                </button>
            </div>
        </div>
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