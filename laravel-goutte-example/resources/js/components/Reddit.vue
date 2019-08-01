<template>
    <div class="container">
        <h1>Hello, Reddit</h1>


    </div>
</template>

<script>
    export default {
        mounted() {
            this.getPosts();
            console.log("Reddit vue mounted");
        },
        data() {
            return {
                posts: {},
            };
        },
        methods: {
            getPosts() {
                axios.get("/posts").then(response => {
                    this.posts = response;
                    console.log(response);
                });
                console.log(this.posts);
            },
            deletePost(id) {
                axios.delete("/posts/" + id).then(response => this.getPosts())
            },
        }
    };
</script>
