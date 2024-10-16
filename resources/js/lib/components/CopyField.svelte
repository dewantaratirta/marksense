<script>
    import { clipboard } from "@skeletonlabs/skeleton";
    import { getToastStore } from "@skeletonlabs/skeleton";

    export let className = "";
    export let baseClass = "flex-row inline-flex items-center rounded-md";
    export let text = "This is Text";
</script>

<div class={"copyfield " + baseClass + " " + className}>
    <div class="flex flex-col">
        <div class="flex flex-row justify-center items-center">
            <h4 class="text-white text-sm px-4">{text}</h4>
            <button
                class="btn variant-soft text-sm text-surface-200"
                use:clipboard={text} on:click={
                    () => {
                        const toastStore = getToastStore();
                        toastStore.trigger({
                            message: "Copied to clipboard",
                            background: "variant-filled-success",
                        });
                    }
                }>Copy</button
            >
        </div>
    </div>
</div>

<style>
    .copyfield {
        background-color: #2a2b2c;
    }
</style>
