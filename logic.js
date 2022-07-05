
// Cards
const logos = Array.from(document.getElementsByClassName('outlet-logo'));
// Filter options
const userOpts = Array.from(document.querySelectorAll(".form-check-input"));

// Cards fadein effect
logos.forEach((card, index) => {
  setTimeout(()=>{
    card.style.transition = "1s";
    card.style.opacity = 1;
  }, index * 250)
})


// Add CSS to selected cards
logos.forEach(logo => logo.addEventListener('click', (e)=> {  
    
    // Add highlighter CSS    
    e.currentTarget.classList.toggle("selected");

    e.currentTarget.getElementsByClassName('unselected-icon')[0].classList.toggle('selected-icon')
}))

// Create filter object
function filterVals(){

    let filters = {}
  
    userOpts.forEach(opt => {
      // select checked boxes only
      if(opt.checked == true) {
        // check whether key exists in filters object
        if((opt.dataset.type in filters) == true) {
          // add to key-property array if it does
          filters[opt.dataset.type].push(opt.value)
        } 
        // create key, array as property, and push value if does not exit
        else {
          filters[opt.dataset.type] = [opt.value]
        }
      }
    })
    // console.log(filters);
    return filters;
}

// Display only cards relevant to dropdown choices
function displaySelect(options){

  // copy of elems to be filtered
  dispPubs = logos;

  // Loop through keys and vals of filter object
  Object.entries(options).forEach(([key, val]) => {
      //for each key in 'objects' (filter Object) filter dispPubs according its value, 
      // By the time this has finished looping through all keys, dispPubs will be reduced to values contained wihtn 
      dispPubs = dispPubs.filter(card => {
        return val.indexOf(card.dataset[key]) != -1
      })
  })
  
  logos.forEach(card => {
    if(dispPubs.indexOf(card) == -1) {
      card.style.display = "none";
    }
    else {
      card.style.display = "block";
    }
  }) 
  
}

// Create filter options. Display selected only
userOpts.forEach(option => {
  option.addEventListener('click', (e) => {
    // Create filter object
    let options = filterVals();
    // Display selected using filter obj
    displaySelect(options)
  })
})

// Request results
const btnGetNews = document.getElementById('get-news').addEventListener('click', (e) => {

  let url = new URL("http://localhost/newsrack/results.php");

  let paramCount = 0;

  logos.forEach((logo, index) => {    
    if (logo.classList.contains('selected')) {
        url.searchParams.append("pub" + paramCount, logo.getAttribute('data-name'));
        paramCount++;
    }
  })

  // Check params are set, to avoid sending request with no options
  if(Array.from(url.searchParams).length != 0) { 
      //Append number of articles   
      let numArticles = document.getElementById('num-articles').value;
      url.searchParams.append("art-num", numArticles);
      // Send request
      location.href = url.href;
  }
  else {
      alert("Select at least one publication");
  }
    
})



