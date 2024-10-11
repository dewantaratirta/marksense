<script>
    import { tradeDetails } from "@/stores/tradeDetailStore.js";
    import { CodeBlock } from "@skeletonlabs/skeleton";
    import hljs from "highlight.js/lib/core";
    import json from "highlight.js/lib/languages/json";
    import { storeHighlightJs } from "@skeletonlabs/skeleton";
    // import { prettyPrintJson } from "pretty-print-json";
    import "highlight.js/styles/atom-one-dark.css";
    import beautify from "simply-beautiful";

    hljs.registerLanguage("json", json);
    storeHighlightJs.set(hljs);

    console.log(
        beautify.json(JSON.stringify($tradeDetails?.unserialized_proof)),
    );
</script>

<div class="px-8 py-12">
    <h4 class="h4 text-bold mb-4 font-bold font-inter">Metadata</h4>

    <CodeBlock
        language="json"
        code={beautify.json(JSON.stringify($tradeDetails?.unserialized_proof))}
    ></CodeBlock>
</div>
