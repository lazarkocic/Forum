<template>
    <div>
        <div v-if="signedIn">

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea   name="body" 
                            id="body" 
                            class="form-control" 
                            placeholder="Have something to say?" 
                            rows="5"
                            required
                            v-model="body"></textarea>
            </div>
            <div class="form-group">
                <button     type="submit" 
                            class="btn btn-primary"
                            @click="addReply">Post</button>
            </div>

        </div>
        

        <p v-else>Please <a href="/login">sign in</a> to participate</p>

    </div>
</template>

<script>
    export default {
        props: ['endpoint'],

        data() {
            return {
                body: ''
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        methods: {
            addReply() {
                axios.post(this.endpoint, { body: this.body})
                    .then(({data}) => {
                        this.body = '';
                        flash("Replied");
                        this.$emit('created', data);
                    });
            }
        }
    }
</script>