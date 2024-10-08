export const niceAddress = (address) => {
	  return `${address.slice(0, 4)}...${address.slice(-6)}`
}

export const nicePnL = (pnl) => {
	  if(typeof pnl == 'string'){
		pnl = parseFloat(pnl);
	  }
	  return `${pnl > 0 ? '+' : ''}${pnl.toFixed(2)}`
}

export default{
	niceAddress,
	nicePnL
}