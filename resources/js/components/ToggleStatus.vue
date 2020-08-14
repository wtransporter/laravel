
<template>
<!-- <input class="align-middle" name="activated" type="checkbox" 
        onChange="this.form.submit()" {{ $post->activated ? 'checked' : '' }}> -->
    <div class="form-check form-check-inline">
        <span class="mr-2 badge "
            :class="checked ? 'badge-success' : 'badge-danger'" v-text="checked ? 'Active' : 'Pending'"></span>
        <input class="align-middle" name="activated" type="checkbox" 
                @click="activate" v-model="checked">
    </div>
</template>

<script>

    export default {
        props: ['data'],
        
        data() {
            return {
                checked: this.data.activated
            }
        },

        methods: {
            activate() {
                this.checked = !this.checked;
                axios.post("/status/" + this.data.slug, {
                    activated: this.checked,
                    _method: 'patch'
                } );
            } 
        }
    }
</script>