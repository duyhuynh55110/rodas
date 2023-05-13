<template>
    <div @click="onClick">
        <IconBack v-if="this.linkIcon == 'link-back'" />
        <IconMenu v-else-if="this.linkIcon == 'link-menu'" />
    </div>
</template>

<script src="./LinkIcon.js"></script>
