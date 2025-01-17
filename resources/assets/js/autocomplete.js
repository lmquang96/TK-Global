const autoCompleteJS = new autoComplete({
  data: {
    src: async () => {
      try {
        document.getElementById('autoComplete').setAttribute('placeholder', 'Loading...');
        // Fetch External Data Source
        const source = await fetch('/campaigns/list');
        const data = await source.json();
        // Post Loading placeholder text
        document.getElementById('autoComplete').setAttribute('placeholder', autoCompleteJS.placeHolder);
        // Returns Fetched data
        return data;
      } catch (error) {
        return error;
      }
    },
    keys: ['id', 'name'],
    cache: true,
    filter: list => {
      // Filter duplicates
      // incase of multiple data keys usage
      const filteredResults = Array.from(new Set(list.map(value => value.match))).map(name => {
        return list.find(value => value.match === name);
      });

      return filteredResults;
    }
  },
  placeHolder: 'shopee',
  resultsList: {
    noResults: true,
    maxResults: 15,
    tabSelect: true
  },
  resultItem: {
    highlight: true
  },
  events: {
    input: {
      focus: () => {
        if (autoCompleteJS.input.value.length) autoCompleteJS.start();
      }
    }
  }
});

autoCompleteJS.input.addEventListener('selection', function (event) {
  const feedback = event.detail;
  autoCompleteJS.input.blur();
  // Prepare User's Selected Value
  const selection = feedback.selection.value[feedback.selection.key];
  // Replace Input value with the selected value
  autoCompleteJS.input.value = selection;
});
