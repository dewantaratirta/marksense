<script>
    import { getEnsName } from '@wagmi/core'
    import {wagmiConfig, account, chains} from '@/lib/web3modal';
    import {onMount} from 'svelte'
    onMount(async()=>{
        //find chain.name == "Base"
        let baseChain = chains.find(chain=>chain.name == "Base");

        let ens = await getEnsName(wagmiConfig,{address: $account?.address, chainId: baseChain.id});
        // console.log(`ens name`, ens);
    })

</script>
