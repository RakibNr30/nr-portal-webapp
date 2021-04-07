<template>
    <div>
        <ProjectMessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
    import ProjectMessageComposer from './ProjectMessageComposer';
    export default {
        props: {
            contact: {
                type: Array,
                required: true
            }            
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }
                axios.post('/conversation/send', {
                    contact_id: this.contact[0].user_id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                })
            }
        },
        components: {ProjectMessageComposer}
    };
</script>