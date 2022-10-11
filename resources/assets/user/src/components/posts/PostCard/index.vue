<template>
    <div class="post-card">
        <div class="post-media">
            <img :src="this.post.full_path_image" alt="" />
        </div>
        <div class="post-info">
            <h3 class="title">{{ this.post.title }}</h3>
        </div>
    </div>
</template>
<style src="./PostCard.scss" scoped lang="scss"></style>
<script src="./PostCard.js"></script>
