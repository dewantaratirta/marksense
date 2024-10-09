import crypto from 'crypto';
import axios from 'axios';
import { ReclaimClient } from '@reclaimprotocol/zk-fetch';
import { Reclaim } from '@reclaimprotocol/js-sdk';

const APP_ID = import.meta.env.VITE_RECLAIM_APP_ID
const APP_SECRET = import.meta.env.VITE_RECLAIM_APP_ID

const reclaimClient = new ReclaimClient(APP_ID, APP_SECRET);

export const createSignature = (queryString, secret = '') =>{
    return crypto.createHmac('sha256', secret).update(queryString).digest('hex');
}

const generateResult = (res, data) => {
    return {status: res, data: data};
};

export const generateProof = async (url, matches, apiKey) =>{
    try {
        const proof = await reclaimClient.zkFetch(url, {
            method: 'GET',
        }, {
            headers: {
                'X-MBX-APIKEY': apiKey
            },
            responseMatches: matches
        });

        if (!proof) {
            return {
                success: false,
                error: "Failed to generate proof"
            }
        }

        const isValid = await Reclaim.verifySignedProof(proof);
        if (!isValid) {
            return {
                success: false,
                error: "Proof is invalid"
            }
        }

        const proofData = await Reclaim.transformForOnchain(proof);

        return {
            success: true,
            data: { transformedProof: proofData, proof }
        };
    } catch (err) {
        let errorMessage;

        if (err instanceof Error) {
            errorMessage = err.message;
        } else {
            errorMessage = String(err);
        }

        return {
            success: false,
            error: errorMessage
        }
    }
}


export const generateProofWithoutContext =  async (url, apiKey)  => {
    try {
        const proof = await reclaimClient.zkFetch(url, {
            method: 'GET',
        }, {
            headers: {
                'X-MBX-APIKEY': apiKey
            },
        });

        if (!proof) {
            return {
                success: false,
                error: "Failed to generate proof"
            }
        }

        const isValid = await Reclaim.verifySignedProof(proof);
        if (!isValid) {
            return {
                success: false,
                error: "Proof is invalid"
            }
        }

        const proofData = await Reclaim.transformForOnchain(proof);

        return {
            success: true,
            data: { transformedProof: proofData, proof }
        };
    } catch (err) {
        let errorMessage;

        if (err instanceof Error) {
            errorMessage = err.message;
        } else {
            errorMessage = String(err);
        }

        return {
            success: false,
            error: errorMessage
        }
    }
}

export const generateUSDMTradeProof = async (params = {}) => {
    const { symbol, orderId, apiKey, apiSecret } = params;
    try{
        const endpoint = '/fapi/v1/userTrades';
        const timestamp = Date.now();
        const queryString = `timestamp=${timestamp}&symbol=${symbol}&orderId=${orderId}`;
        const signature = createSignature(queryString, apiSecret);
    
        const result = await generateProofWithoutContext(
          `https://fapi.binance.com${endpoint}?${queryString}&signature=${signature}`,
          apiKey
        );
    
        if (!result.success) {
        //   return res.status(400).send(result.error);
            return generateResult(false, result.error);
        }
        
        // return res.status(200).json(result.data);
        return generateResult(true, result.data);
      } catch(e){
          console.log(e);
        // return res.status(500).send(e.message);
        return generateResult(false, e.message);
      }
};

export default {
    createSignature,
    generateProof,
    generateProofWithoutContext,
    generateUSDMTradeProof
}