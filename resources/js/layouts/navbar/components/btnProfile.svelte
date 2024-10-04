<script>
    import { web3modal, account as accountInfo } from "@/lib/web3modal";
    import { inertia, Link } from "@inertiajs/svelte";

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

<Link class="btn hover:variant-soft-primary" href={link}>Profile</Link>
