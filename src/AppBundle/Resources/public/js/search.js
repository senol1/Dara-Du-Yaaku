L.Control.Search = L.Control.extend({
    that: this,
    options: {
        // topright, topleft, bottomleft, bottomright
        position: 'topleft',
        placeholder: 'Quartier...'
    },
    fuse_options: {
        shouldSort: true,
        tokenize: true,
        includeScore: true,
        includeMatches: true,
        threshold: 0.4,
        location: 0,
        distance: 100,
        maxPatternLength: 32,
        minMatchCharLength: 4,
        keys: [
            "properties.nom",
            "properties.adresse",
            "properties.region",
            "properties.departement",
            "properties.commune"
        ]
    },

    initialize: function (options /*{ data: {...}  }*/) {
        // constructor
        L.Util.setOptions(this, options);
    },
    setSearchData: function (data) {
        this.options.data = data;
        return this.options.data.length > 1;
    },
    onAdd: function (map) {
        // happens after added to map
        var container = L.DomUtil.create('div', 'search-container');
        container.style.cssText = 'max-width: 250px; min-width: 250px; ';
        this.form = L.DomUtil.create('form', 'form', container);
        var group = L.DomUtil.create('div', 'form-group', this.form);
        this.input = L.DomUtil.create('input', '', group);
        this.input.type = 'search';
        this.input.placeholder = this.options.placeholder;
        this.results = L.DomUtil.create('div', 'content list', group);
        L.DomEvent.addListener(this.input, 'keyup', _.debounce(this.keyup, 300), this);
        L.DomEvent.addListener(this.input, 'focusout', function (e) {
            var elem = e.target
            if (elem.value != "" && elem.value.length > 2) {
                e.preventDefault();
                elem.focus();
            }
        }, this);
        L.DomEvent.addListener(this.input, 'dblclick', function (e) {
            e.target.focusout();
        });
        L.DomEvent.addListener(this.form, 'submit', this.submit, this);
        L.DomEvent.disableClickPropagation(container);
        return container;
    },
    onRemove: function (map) {
        // when removed
        L.DomEvent.removeListener(this._input, 'keyup', this.keyup, this);
        L.DomEvent.removeListener(form, 'submit', this.submit, this);
    },
    keyup: function (e) {
        console.log(e.target.value);
        // var that = this;
        // var fuse = new Fuse(this.options.data, this.fuse_options);
        // if (e.keyCode === 38 || e.keyCode === 40) {
        //     // do nothing
        // } else {
        //     var searchResults = this.results;
        //     searchResults.innerHTML = '';
        //     if (this.input.value.length > 2) {
        //
        //         var value = this.input.value;
        //         var results = fuse.search(value);
        //         _.map(results, function (x) {
        //             var a = L.DomUtil.create('a', 'list-item');
        //             var text = L.DomUtil.create('div', 'list-text', a);
        //             // a.href = '#';
        //             a.setAttribute('data-result-name', x.item.properties.nom);
        //             text.innerHTML = x.item.properties.nom;
        //             // a.onclick = that.itemSelected;
        //             searchResults.appendChild(a);
        //             L.DomEvent.addListener(a, 'click', this.itemSelected, this);
        //
        //             return a;
        //         }, this);
        //     }
        // }
    },
    itemSelected: function (e) {
        L.DomEvent.preventDefault(e);
        var elem = e.target;
        var value = elem.innerHTML;
        var searchString = value; //elem.getAttribute('data-result-name');

        var feature = _.find(this.options.data, function (x) {
            return x.properties.nom === searchString;
        }, this);

        if (feature) {
            this._map.flyTo(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), 18);
        }
        this.results.innerHTML = '';
    },
    submit: function (e) {
        L.DomEvent.preventDefault(e);
    }

});

L.control.search = function (id, options) {
    return new L.Control.Search(id, options);
}
