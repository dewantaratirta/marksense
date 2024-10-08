<script>
    import { submitData } from "@/stores/submitData";
    import { page } from "@inertiajs/svelte";

    
    let active = 1;
    let group_selected = "male";
    let group_list = [
        {
            id: "male",
            name: "Male",
            min: 1,
            max: 50,
        },
        {
            id: "female",
            name: "Female",
            min: 51,
            max: 100,
        },
    ];
    let group_info = group_list[0];
    let selected = 1;

    const handleChangeGroup = (group) => {
        group_selected = group;
        group_info = group_list.find((item) => item.id === group);
    };

    const handleClickAvatar = (id) => {
        selected = id;
    };

    const handleSave = async (selected) => {
        let data = {
            avatar: selected,
        };
        let res = await $submitData({
            data: data,
            url: $page?.props.edit_avatar_url,
            token: $page.props.token,
        });

        if(!res.hasOwnProperty("errors")) {
            window.location.reload();
        }
    };
</script>

<div class="card bg-white shadow-md p-4 w-3/4">
        <div class="flex justify-center mb-4">
            {#each group_list as group}
                <button
                    class="btn"
                    class:variant-filled-primary={group_selected === group.id}
                    on:click={() => handleChangeGroup(group.id)}
                >
                    {group.name}
                </button>
            {/each}

            <button class="ms-4 btn variant-soft-primary"  
            on:click={() => {
                handleSave(selected);
            }}
            >Save</button>
        </div>

    <div class="flex overflow-y-scroll justify-center" id="avatarcontainer">
        <section
            class="flex flex-row flex-wrap items-center justify-center w-full"
        >
            {#each Array.from({ length: 50 }, (_, i) => i + 1) as item}
                <button
                    class={selected === group_info.min + item - 1
                        ? "avatar selected"
                        : "avatar"}
                    on:click={() => {
                        let id = group_info.min + item - 1;
                        handleClickAvatar(id);
                    }}
                >
                    <img
                        class="aspect-square h-20 w-20 md:h-32 md:w-32"
                        src={`https://avatar.iran.liara.run/public/` +
                            (group_info.min + item - 1)}
                        alt="example"
                    />
                </button>
            {/each}
        </section>
    </div>
</div>

<style lang="postcss">
    button:focus {
        outline: none !important;
    }
    #avatarcontainer {
        max-height: 75vh;
    }

    button.avatar {
        @apply rounded-full block border-4 m-2
    }

    button.avatar.selected {
        border-color: rgb(var(--color-primary-500));
    }
</style>
