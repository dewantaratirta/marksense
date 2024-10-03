export const niceAddress = (address) => {
	  return `${address.slice(0, 4)}...${address.slice(-6)}`
}