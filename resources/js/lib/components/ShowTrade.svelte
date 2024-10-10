<script>
    import { niceAddress } from "@/lib/utils";
    import { Link } from "@inertiajs/svelte";

    export let trade;
    export let wallet;

    console.log(trade);
    console.log(wallet);
</script>

<div class="flex flex-col items-center">
    <div class="flex flex-col my-4 max-w-md">
        <div class="bg-white border border-white shadow-lg rounded-3xl">
            <div class="card bg-initial card-hover overflow-hidden">
                <header>
                    <img
                        src={trade?.image_url}
                        class="bg-black/50 w-full"
                        alt="Post"
                    />
                </header>
                <div class="p-4 space-y-4">
                    <h3 class="h3" data-toc-ignore="">{trade?.trade_pnl_symbol}</h3>
                    <!-- <article>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Numquam aspernatur provident eveniet eligendi
                            cumque consequatur tempore sint nisi sapiente. Iste
                            beatae laboriosam iure molestias cum expedita
                            architecto itaque quae rem.
                        </p>
                    </article> -->
                </div>
                <hr class="opacity-50" />
                <footer class="p-4 flex justify-start items-center space-x-4">
                    <figure
                        class="avatar flex aspect-square text-surface-50 font-semibold justify-center items-center overflow-hidden isolate bg-surface-400-500-token w-8 rounded-full"
                        data-testid="avatar"
                    >
                        <img
                            class="avatar-image w-full object-cover"
                            style=""
                            src={wallet?.avatar_url}
                            alt=""
                        />
                    </figure>
                    <div class="flex-auto flex justify-between items-center">
                        <Link href={`/app/profile/${wallet?.wallet_address}`}>
                            <h6 class="font-bold" data-toc-ignore="">@{wallet.wallet_username}</h6>
                            <p class="text-sm text-gray-500">{niceAddress(wallet?.wallet_address ?? "                                   ")}</p>
                        </Link>
                        <small>On {trade?.human_date}</small>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>
