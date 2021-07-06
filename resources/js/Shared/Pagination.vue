<template>
    <ul class="pagination m-0" v-if="links.length > 3">
        <template v-for="(link, key) in links">
            <li v-if="link.url === null" class="page-item"><span class="page-link" v-html="link.label"></span> </li>
            <li v-else class="page-item" :class="{'active' : link.active}"><inertia-link class="page-link" :href="link.url" v-html="link.label"></inertia-link></li>
        </template>
    </ul>
</template>

<script>
export default {
    props: {
        links: Array,
    },
}
</script>