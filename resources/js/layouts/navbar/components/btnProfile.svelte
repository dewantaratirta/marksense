<script>
    import { web3modal, account as accountInfo } from "@/lib/web3modal";
    import { inertia, Link } from "@inertiajs/svelte";
    export let classNames = "variant-soft-primary";
    export let basicClass = "btn w-full text-left ";

    let modal = false;
    let account = "";
    let link;

    web3modal.subscribe((value) => {
        modal = value;
    });

    $: {
        account = $accountInfo?.address;
        if (
            account !== undefined &&
            account !== null &&
            account !== false &&
            account !== ""
        ) {
            link = `/app/profile/${account}`;
        } else {
            link = "/app/create_account";
        }
    }
</script>

<Link class={basicClass + classNames} href={link}>Profile</Link>
