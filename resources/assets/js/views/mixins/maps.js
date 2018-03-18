export default {
	data() {
		return {
			coordinates : []
		};
	},

	methods: {
		initializeMap(item) {
			this.items.push(item);

			this.$emit('added');
		},

		remove(index) {
			this.items.splice(index, 1);

			this.$emit('removed');
		}
	}
}
