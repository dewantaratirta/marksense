<script>
    import MainIcon from "./navbar/mainIcon.svelte";
    import MainMenu from "./navbar/mainMenu.svelte";
    import AppMenu from "./navbar/appMenu.svelte";
    import Section from "@/lib/components/Section.svelte";

    export let state = "main";
    export let Icon;
    export let Menu;

    switch (state) {
        case "app":
            Icon = MainIcon;
            Menu = AppMenu;
            break;
        case "main":
        default:
            Icon = MainIcon;
            Menu = MainMenu;
            break;
    }
</script>

<header id="shell-header" class="flex-none z-10">
    <div
        class="app-bar flex justify-center space-y-4 p-4 shadow-2xl"
        data-testid="app-bar"
        role="toolbar"
        aria-label=""
        aria-labelledby=""
    >
        <div class="container sm:px-8">
            <div
                class="app-bar-row-main grid items-center grid-cols-[auto_1fr_auto] gap-4"
            >
                <div
                    class="app-bar-slot-lead flex-none flex justify-between items-center min-w-1"
                >
                    <svelte:component this={Icon} />
                </div>

                <div class="app-bar-slot-default flex-auto"></div>

                <div
                    class="app-bar-slot-trail flex-none flex items-center space-x-4 !space-x-2"
                >
                    <svelte:component this={Menu} />
                </div>
            </div>
        </div>
    </div>
</header>
