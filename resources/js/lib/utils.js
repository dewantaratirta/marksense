import {clsx } from "clsx";
import { twMerge } from "tailwind-merge";

 export function cn(...inputs) {
	return twMerge(clsx(inputs));
 }

export const niceAddress = (address) => {
	  return `${address.slice(0, 4)}...${address.slice(-6)}`
}

export const nicePnL = (pnl) => {
	  if(typeof pnl == 'string'){
		pnl = parseFloat(pnl);
	  }
	  return `${pnl > 0 ? '+' : ''}${pnl.toFixed(2)}`
}

//generate random string with length as params
export const randomString = (length) => {
	  let result = '';
	  let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	  let charactersLength = characters.length;
	  for (let i = 0; i < length; i++) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	  }
	  return result;
}

export default{
	niceAddress,
	nicePnL,
	randomString
}