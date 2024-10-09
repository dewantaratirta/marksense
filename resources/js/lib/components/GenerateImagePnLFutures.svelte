<svelte:options accessors />

<script>
    import { onMount } from "svelte";
    import pnl_bg from "@img/pnl_bg.png";
    import { QRCodeImage } from "svelte-qrcode-image";
    import { canvasFutureStore } from "@/stores/canvasFutureStore";

    export let trade;

    const canvasSize = 600;
    let initialize = false;
    let updateCanvasInitialized = false;
    let canvas;
    let Svg;
    let svgElement;
    let Qrc;
    let QrcInitialized = false;
    let loading = true;
    let images = [];
    let text = [];

    let baseTextOptions = {
        ctx: undefined,
        text: "",
        x: 0,
        y: 0,
        font: "bold 42px Montserrat",
        color: "#0052FF",
        textAlign: "left",
    };

    const createText = (params = {}) => {
        let opts = { ...baseTextOptions, ...params };
        let { ctx, text, x, y, font, color } = opts;
        ctx.font = font;
        ctx.fillStyle = color;

        if (x == "center") {
            x = (ctx.canvas.width - ctx.measureText(text).width) / 2;
        }

        ctx.fillText(text, x, y);
        console.log(`text: ${text} x: ${x} y: ${y}`);
    };

    const addImage = async (ctx, img, x, y, dwidth, dheight) => {
        return new Promise((resolve, reject) => {
            console.log("adding image");
            if (images[img]) return resolve();
            //generate random str
            images[img] = new Image();
            images[img].src = img;
            images[img].setAttribute('crossorigin', 'anonymous');
            images[img].onload = () => {
                ctx.drawImage(images[img], x, y, dwidth, dheight);
                resolve();
            };
            images[img].onerror = reject;
        });
    };

    onMount(async () => {
        let ctx = canvas.getContext("2d");
        // set with height
        ctx.canvas.width = canvasSize;
        ctx.canvas.height = canvasSize;
        await addImage(ctx, pnl_bg, 0, 0, 600, 600);
        initialize = true;
        if (!trade) return;
    });

    const updateTradeCanvas = async () => {
        if (Object.keys(trade).length == 0 || updateCanvasInitialized == true)
            return;
        updateCanvasInitialized = true;

        let ctx = canvas.getContext("2d");

        // add user avatar set fetch tp anonymous
        // await fetch(trade.wallet.avatar_url, {
        //     mode: "cors",
        //     headers: {
        //         "Access-Control-Allow-Origin": "*",
        //     },
        // });
        await addImage(ctx, trade.wallet.avatar_url, 66, 66, 150, 150);

        // add username
        createText({
            ctx: ctx,
            text: `@${trade.wallet.wallet_username}`,
            x: 215,
            y: 115,
        });

        // add date
        if (trade?.human_time) {
            createText({
                ctx: ctx,
                text: trade.human_time,
                x: 225,
                y: 150,
                font: "400 18px Montserrat",
                color: "#1E1E1E",
            });
        }

        // add trade symbol
        createText({
            ctx: ctx,
            text: trade.symbol,
            x: "center",
            y: 260,
            font: "bold 40px Montserrat",
            color: "#000",
        });

        //calculate PnL
        let pnl = parseFloat(trade.pnl);

        let colorPnl = "#00FF00";
        if (pnl < 0) {
            colorPnl = "#FF0000";
        }

        // add pnl
        createText({
            ctx: ctx,
            text: `${pnl.toFixed(2)} ${trade.commission_asset}`,
            x: "center",
            y: 340,
            font: "bold 64px Montserrat",
            color: colorPnl,
        });

        //canvas to image blob
        let canvasFuture = canvas.toDataURL("image/png"); //base 64
        //baste64 to blob
        canvasFuture = await fetch(canvasFuture).then((res) =>  res.blob());
        let blobUrl = URL.createObjectURL(canvasFuture);
        canvasFutureStore.set(blobUrl);

        loading = false;
    };

    const qrCodeInitialize = async () => {
        if (QrcInitialized == true) return;
        QrcInitialized = true;
        let qrel = document.getElementById("qr_holder")?.querySelector("img");

        await addImage(canvas.getContext("2d"), qrel.src, 424, 440, 110, 110);
    };

    $: {
        if (initialize) {
            if (trade && canvas && updateCanvasInitialized == false) {
                updateTradeCanvas();
            }

            if (Qrc && QrcInitialized == false) {
                console.log(trade);
                qrCodeInitialize();
            }

            loading;
        }
    }
</script>

{#if loading}
    <p>Loading....</p>
{/if}
<canvas bind:this={canvas} class={loading ? "hidden" : ""} />

{#if Object.keys(trade).length > 0}
    <div class="hidden" id="qr_holder">
        <QRCodeImage
            text={window.location.origin + "/app/trade/" + trade?.reserve_ulid}
            width={120}
            bind:this={Qrc}
        />
    </div>
{/if}
