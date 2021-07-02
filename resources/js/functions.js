module.exports = {
    methods: {
        route,
        /**
         * Translate the given key.
         */
        __(key) {
            if (null == this.$page.props.language) {
                return key;
            }
            var translation = this.$page.props.language[key]
            
                ? this.$page.props.language[key]
                : key
            return translation;
        },
        can(key) {
            return this.$page.props.userPermissions.includes(key);
        },
    },
}