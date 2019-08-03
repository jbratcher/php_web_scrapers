<template>

    <div class="container">

        <h1 class="text-center">Hello, Reddit</h1>

        <section v-for="post in posts" :key="post.id" class="card-container">

            <div class="card">

                <img v-if="post.image_src" :src="post.image_src" class="card-img-top" alt="...">

                <div class="card-body">

                    <a :href="post.link">
                        <h3 class="card-title">{{ post.title }}</h3>
                    </a>

                    <a :href="post.subreddit_link">
                        <p class="card-text">{{ post.subreddit }}</p>
                    </a>

                    <a :href="post.user_link">
                        <p class="card-text">{{ post.user }}</p>
                    </a>

                    <p v-if="post.upvotes" class="card-text">{{ post.upvotes }}</p>

                    <a :href="post.comment_link">
                        <p class="card-text">{{ post.comment_count }}</p>
                    </a>

                </div>
            </div>

        </section>

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
                    this.posts = response.data;
                });
                console.log("Posts object: " + this.posts);
            },
            deletePost(id) {
                axios.delete("/posts/" + id).then(response => this.getPosts())
            },
        }
    };
</script>
