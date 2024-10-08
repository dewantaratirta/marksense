import { getToastStore } from "@skeletonlabs/skeleton";

export const ToastError = async (options) => {
    const toastStore = getToastStore();

    let ToastSettings = {
        background: "variant-filled-error",
        ...options
    };
    await toastStore.trigger(ToastSettings);
}

export default ToastError;