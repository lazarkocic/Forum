<template>

    <div :id="'reply-'+id" class="panel panel-default">

        <div class="panel-heading">
        <div class="level">

            <div class="flex">

            <a :href="'/profiles/'+ data.owner.name" v-text="data.owner.name"></a> said
            <strong>{{ data.created_at }}</strong>

            </div>
            
            <div v-if="signedIn">

                <favourite :reply="data"></favourite>

            </div>

        </div>

        </div>

        <div class="panel-body">
        <div v-if="editing">
            <div class="form-group">
            <textarea class="form-control" v-model="body"></textarea>
            </div>
            <button class="btn btn-xs btn-link" @click="update">Update</button>
            <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>        
        </div>
        <div v-else v-text="body">
        </div>
        </div>

        <div class="panel-footer level" v-if="canUpdate">

            <button class="btn btn-xs mr1" @click="editing = true"> Edit</button>
            <button class="btn btn-danger btn-xs" @click="destroy">Delete</button>

        </div>
  </div>

</template>

<script>

    import Favourite from './Favourite.vue';

    export default {

        components: {
            Favourite
        },

        props: ['data'],

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },
            canUpdate() {
                return this.authorize(user => this.data.user_id == user.id);
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Updated');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);
            }
        }

    }
</script>