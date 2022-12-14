const {createApp} = Vue

createApp({
	data() {
		return {
			goods: [],
			search_query: ''
		}
	},
	methods: {
		async fetchGoods() {
			this.goods = await fetch('/wp-json/dlcd/v1/accessories')
				.then(res => res.json())
		}
	},
	computed: {
		filteredGoods() {
			return this.goods.filter((good) => good.sku.toLowerCase().includes(this.search_query.toLowerCase()))
		}
	},
	async mounted() {
		await this.fetchGoods()
	}
}).mount('#accessories-app');