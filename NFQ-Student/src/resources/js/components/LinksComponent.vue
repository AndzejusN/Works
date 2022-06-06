<template>
    <footer class="py-3 px-5">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center pb-3 mb-4 border-top">
        <nav class="d-inline-flex">
            <RouterLink class="me-3 py-2 text-dark text-decoration-none" :to="{name: 'test1'}"><h5>First</h5></RouterLink>
            <RouterLink class="me-3 py-2 text-dark text-decoration-none" :to="{name: 'test2'}"><h5>Second</h5></RouterLink>
        </nav>
    </div>
    </footer>
</template>

<script>
</script>

<style scoped>
</style>
