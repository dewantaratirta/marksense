import { writable } from "svelte/store";
import { connect } from "@wagmi/core";
import { account, web3modal, wagmiConfig, reconnect } from "$lib/web3modal";
import Section from "@/lib/components/Section.svelte";
import { signMessage, verifyMessage } from "@wagmi/core";
import { getToastStore, initializeStores } from "@skeletonlabs/skeleton";
import TextError from "@/lib/components/TextError.svelte";


const sendToServer = async (url, payload) => {
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        body: JSON.stringify(payload),
    });

    // get response body
    return await response.json();
};

const save = async (params) => {
    const cb_success = () => {};
    const cb_error = () => {};
    const { url, data, token } = params;

    let account_data;
    await account.subscribe((value) => {
        account_data = value;
    });


    // payload
    const payload = {
        data: data,
        wallet: account_data.address,
    };



    try {
        if(!account_data?.address) {
            await connectWallet();
        }

        const _signature = await signMessage(wagmiConfig, {
            message: JSON.stringify(payload),
        });

        const _verify = await verifyMessage(wagmiConfig, {
            address: account_data.address,
            message: JSON.stringify(payload),
            signature: _signature,
        });

        if (_signature !== "null" && _verify) {
            let dataToSend = {
                ...data,
                wallet: account_data.address,
                signature: _signature,
                _token: token,
            }
            // send the payload to the server using ajax
            return await sendToServer(url, dataToSend);
        } else {
            throw new Error("The signature was rejected");
        }
    } catch (error) {
        console.log(`error: ${error.message}`);
        throw new Error(error.message);
    }
};

export const submitData = writable(save);