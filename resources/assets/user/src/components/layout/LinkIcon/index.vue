<template>
    <IconBack v-if="this.linkIcon == 'link-back'" />
    <IconMenu v-else-if="this.linkIcon == 'link-menu'" />
</template>

<script src="./LinkIcon.js"></script>
