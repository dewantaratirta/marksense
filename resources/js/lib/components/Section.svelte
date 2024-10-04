<script>
    export let className = "";
</script>

<div class={"section " + className}>
    <slot />
</div>

<style lang="postcss">
    .section {
        @apply container mx-auto p-8 space-y-8;
    }
</style>
