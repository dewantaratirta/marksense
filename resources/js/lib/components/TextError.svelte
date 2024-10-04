<script>
    export let message = [];
</script>

{#if message}
    <div class="text-red-500 text-sm">
        {#each message as msg, i}
            <p>{msg}</p>
        {/each}
    </div>
{/if}

