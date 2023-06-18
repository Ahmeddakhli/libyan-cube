
class SiteHeader extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.innerHTML = /* html */`
      <header class="main-header">

        <nav class="navbar navbar-expand-lg">
          <div class="container">

            <a class="navbar-brand p-0 m-0" href="index.html">
              <img class="dark-logo" src="assets/logo/logo.png" alt="">
              <img class="white-logo" src="assets/logo/logo-white.png" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu"
              aria-expanded="false">
            </button>

            <div class="collapse navbar-collapse" id="main-menu">
              <ul class="navbar-nav align-items-lg-center ms-auto my-lg-0 my-3 mb-lg-0">

                <li class="nav-item active">
                  <a class="nav-link" href="about.html">about</a>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    properties
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="units.html" style="--delay:.0s">Rent</a></li>
                    <li><a class="dropdown-item" href="units.html" style="--delay:.1s">Resale</a></li>
                    <li><a class="dropdown-item" href="units.html" style="--delay:.2s">new homes</a></li>
                    <li><a class="dropdown-item" href="units.html" style="--delay:.3s">commercial</a></li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="developers.html">developers</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="blogs.html">blogs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="services.html">services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="careers.html">join us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">contact</a>
                </li>
                <li class="nav-item">
                  <a class="site-btn sell-btn" data-bs-toggle="modal" href="#sell-modal">
                    Sell your unit
                  </a>
                </li>

                <li class="nav-item change-mode">
                  <button class="theme-toggle" id="theme-toggle" title="Toggles light &amp; dark">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                      <mask id="moon" class="moon">
                        <rect x="0" y="0" width="100%" height="100%" fill="#fff"></rect>
                        <circle cx="40" cy="8" r="11" fill="#000"></circle>
                      </mask>
                      <circle class="sun" cx="12" cy="12" r="11" mask="url(#moon)"></circle>
                      <g class="sun-beams">
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                      </g>
                    </svg>
                  </button>
                </li>

                <li class="nav-item">
                  <a class="nav-link lang-btn d-flex align-items-center gap-1" href="#">
                    <svg width="20" viewBox="0 0 100 100"><path fill="currentColor" d="M49.947 0A50 50 0 0 0 0 50a50 50 0 0 0 50 50a50 50 0 0 0 50-50A50 50 0 0 0 50 0a50 50 0 0 0-.053 0zM52.5 5.682c5.268.896 10.302 5.236 14.268 12.437c1.278 2.321 2.42 4.927 3.408 7.75H52.5V5.682zm-5 .197v19.99H30.75c.988-2.823 2.13-5.429 3.408-7.75C37.89 11.341 42.571 7.102 47.5 5.88zM35.98 7.232c-2.324 2.352-4.41 5.22-6.203 8.475c-1.68 3.05-3.125 6.467-4.312 10.162H12.01c5.535-8.706 13.975-15.37 23.97-18.637zm29.41.463c9.398 3.413 17.32 9.868 22.6 18.174H75.455c-1.184-3.695-2.627-7.112-4.307-10.162c-1.676-3.045-3.613-5.749-5.757-8.012zM9.257 30.87h14.808c-1.245 5.162-2.008 10.76-2.203 16.631H5.072a44.79 44.79 0 0 1 4.184-16.63zm19.974 0H47.5V47.5H26.867c.212-5.935 1.043-11.554 2.363-16.63zm23.27 0h19.195c1.32 5.077 2.152 10.696 2.364 16.631H52.5V30.87zm24.355 0h13.89a44.79 44.79 0 0 1 4.181 16.63H79.053c-.194-5.872-.955-11.468-2.198-16.63zM5.072 52.5h16.762c.129 5.856.82 11.454 1.994 16.63H9.256A44.79 44.79 0 0 1 5.072 52.5zm21.762 0H47.5v16.63H28.98c-1.245-5.1-2.006-10.715-2.146-16.63zm25.666 0h21.592c-.14 5.915-.902 11.53-2.147 16.63H52.5V52.5zm26.576 0h15.852a44.79 44.79 0 0 1-4.184 16.63H77.09c1.17-5.177 1.857-10.775 1.986-16.63zM12.01 74.13h13.136c1.242 4.085 2.8 7.84 4.631 11.165c1.438 2.61 3.068 4.969 4.854 7.017c-9.407-3.41-17.336-9.869-22.621-18.181zm18.394 0H47.5v20.798c-.308-.017-.612-.048-.918-.07c-4.59-1.5-8.924-5.62-12.424-11.975c-1.428-2.594-2.692-5.537-3.754-8.752zm22.096 0h18.021c-1.06 3.216-2.325 6.159-3.753 8.753c-3.428 6.225-7.656 10.308-12.141 11.883a45.48 45.48 0 0 1-2.127.162V74.13zm23.275 0H87.99a45.06 45.06 0 0 1-21.228 17.641c1.604-1.92 3.075-4.094 4.386-6.476c1.831-3.325 3.388-7.08 4.627-11.164z" color="currentColor"/></svg>
                    <span>عربي</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
    `;
  }
};

class cookieComponent extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.innerHTML = /* html */`
      <div class="cookie-banner">
        <div class="">
          <img class="cookie-icon" src="assets/icons/cookie.png" />
          <p>
            We serve cookies on this site to analyze traffic, remember your preferences, and optimize your experience.
          </p>
        </div>

        <div class="mt-3">
          <a href="https://policies.google.com/technologies/cookies" target="_blank" rel="noopener" noreferrer class="site-btn">LEARN MORE</a>
          <button class="site-btn cookie-btn">OK</button>
        </div>
      </div>
    `;
  }
};

class SiteFooter extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    const yearNow = new Date().getFullYear();
    this.innerHTML = /* html */`
      <footer class='main-footer'>
        <div class="container">

          <div class="contacts__social">
            <span class="d-md-block d-none">Follow us:</span>
            <a class="contacts__social--link" href="#" title="Facebook">
              <i class="ri-facebook-line"></i>
            </a>
            <a class="contacts__social--link" href="#" title="Twitter">
              <i class="ri-twitter-line"></i>
            </a>
            <a class="contacts__social--link" href="#" title="Instagram">
              <i class="ri-instagram-line"></i>
            </a>
            <a class="contacts__social--link" href="#" title="Linkedin">
              <i class="ri-linkedin-line"></i>
            </a>
            <a class="contacts__social--link" href="#" title="Youtube">
              <i class="ri-youtube-line"></i>
            </a>
          </div>
        </div>

        <hr>

        <div class="container">

          <div class="accordion">
            <div class="row my-md-5 py-md-3">

              <div class="col-lg-3 col-md-6">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#footer-acc-1"
                      aria-expanded="false">
                      contact us
                    </button>
                  </h2>
                  <div id="footer-acc-1" class="accordion-collapse collapse dont-collapse-sm">
                    <div class="accordion-body">
                      <ul>
                        <li>
                          <address>
                            <i class="ri-map-pin-line"></i>
                            Villa 13, Street Number 316, Maadi, Cairo, Egypt
                          </address>
                        </li>
                        <li>
                          <address>
                            <i class="ri-map-pin-line"></i>
                            23 Fawzi Moaaz st, Smouha, Alexandria, Egypt
                          </address>
                        </li>
                        <li>
                          <a href='tel:+020 1212500025'>
                            <i class="ri-phone-line"></i>
                            <bdi>+020 1212500025</bdi>
                          </a>
                        </li>
                        <li>
                          <a href='mailto:ask@theadvisors.agency'>
                            <i class="ri-mail-line"></i>
                            ask@theadvisors.agency
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#footer-acc-2"
                      aria-expanded="false">
                      Fast links
                    </button>
                  </h2>
                  <div id="footer-acc-2" class="accordion-collapse collapse dont-collapse-sm">
                    <div class="accordion-body">
                      <ul class='text-capitalize'>
                        <li><a href="about.html">about Us</a></li>
                        <li><a href="index.html">Home Page</a></li>
                        <li><a href="units.html">All Properties</a></li>
                        <li><a href="blogs.html">From Our Blog</a></li>
                        <li><a href="projects.html">Our Projects</a></li>
                        <li><a href="privacy.html">privacy & Policy</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#footer-acc-3"
                      aria-expanded="false">
                      properties
                    </button>
                  </h2>
                  <div id="footer-acc-3" class="accordion-collapse collapse dont-collapse-sm">
                    <div class="accordion-body">
                      <ul class='text-capitalize'>
                        <li><a href="units.html">Apartments For Sale</a></li>
                        <li><a href="units.html">Apartments For Rent</a></li>
                        <li><a href="units.html">Villas For Sale</a></li>
                        <li><a href="units.html">Villas For Rent</a></li>
                        <li><a href="units.html">Offices For Sale</a></li>
                        <li><a href="units.html">Offices For Rent</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#footer-acc-4"
                      aria-expanded="false">
                      projects
                    </button>
                  </h2>
                  <div id="footer-acc-4" class="accordion-collapse collapse dont-collapse-sm">
                    <div class="accordion-body">
                      <ul class='text-capitalize'>
                        <li><a href="projects.html">iCity</a></li>
                        <li><a href="projects.html">Jefaira</a></li>
                        <li><a href="projects.html">Anka</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr>

        <div class="copyrights text-center">
          <div class="container">

            <p> &copy;${yearNow} The Advisors, Made With
              <i class="ri-heart-fill ri-lg"></i> By
              <a href='https://www.8worx.com/' target='_blank' class='eight-worx-webpage'>
                8WORX
              </a>
              &trade;
            </p>
          </div>
        </div>
      </footer>
    `;
  }
};

class SearchBox extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.innerHTML = /* html */`
      <div class="search-box">
        <form class="search-form">

          <div class="nav nav-pills nav-with-indicator mb-3">
            <button class="nav-link active" data-bs-toggle="pill" aria-selected="true" type="button">Buy</button>
            <button class="nav-link" data-bs-toggle="pill" aria-selected="false" type="button">Rent</button>
            <button class="nav-link" data-bs-toggle="pill" aria-selected="false" type="button">New homes</button>
            <button class="nav-link" data-bs-toggle="pill" aria-selected="false" type="button">commercial</button>
            <span class="nav-indicator"></span>
          </div>

          <div class="row g-2 align-items-start">

            <div class="col-lg-11">
              <div class="row g-2">

                <div class="col-12 col-md-6">
                  <input class="autocomplete-input form-control" type="text" placeholder="Area, Project, Developer">
                </div>

                <div class="col-6 col-md-3">
                  <select class="form-select form-select-checkbox" multiple placeholder="Beds & Baths">
                    <optgroup label="Bedrooms">
                      <option>studio</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>+6</option>
                    </optgroup>
                    <optgroup label="Bathrooms">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>+6</option>
                    </optgroup>
                  </select>
                </div>

                <div class="col-6 col-md-3">
                  <select class="form-select dd-select" placeholder="property type">
                    <option></option>
                    <option>Apartment</option>
                    <option>Villa</option>
                    <option>Townhouse</option>
                    <option>Compound</option>
                    <option>Penthouse</option>
                  </select>
                </div>

                <div class="col-12 collapse" id="moreOptions">
                  <div class="row g-2 align-items-center">

                    <div class="col-6 col-lg-3 col-sm-4">
                      <select class="form-select dd-select" data-filter="true" placeholder="Min.price(EGP)">
                        <option></option>
                        <option>500.000</option>
                        <option>1000.000</option>
                        <option>1.500.000</option>
                        <option>2000.000</option>
                        <option>2.500.000</option>
                        <option>3.000.000</option>
                        <option>3.500.000</option>
                        <option>4.000.000</option>
                        <option>4.500.000</option>
                      </select>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <select class="form-select dd-select" data-filter="true" placeholder="Max.price(EGP)">
                        <option></option>
                        <option>500.000</option>
                        <option>1000.000</option>
                        <option>1.500.000</option>
                        <option>2000.000</option>
                        <option>2.500.000</option>
                        <option>3.000.000</option>
                        <option>3.500.000</option>
                        <option>4.000.000</option>
                        <option>4.500.000</option>
                      </select>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <select class="form-select dd-select" placeholder="payment method">
                        <option></option>
                        <option>Cash</option>
                        <option>Installements</option>
                        <option>half cash</option>
                      </select>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <select class="form-select dd-select" data-filter="true" placeholder="Down payment From">
                        <option></option>
                        <option>500.000</option>
                        <option>1000.000</option>
                        <option>1.500.000</option>
                        <option>2000.000</option>
                        <option>2.500.000</option>
                        <option>3.000.000</option>
                        <option>3.500.000</option>
                        <option>4.000.000</option>
                        <option>4.500.000</option>
                      </select>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <select class="form-select dd-select" data-filter="true" placeholder="Down payment To">
                        <option></option>
                        <option>500.000</option>
                        <option>1000.000</option>
                        <option>1.500.000</option>
                        <option>2000.000</option>
                        <option>2.500.000</option>
                        <option>3.000.000</option>
                        <option>3.500.000</option>
                        <option>4.000.000</option>
                        <option>4.500.000</option>
                      </select>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <select class="form-select dd-select" placeholder="Finishing">
                        <option></option>
                        <option>Unfinished</option>
                        <option>Core Shell</option>
                        <option>Finished</option>
                        <option>Semi Finished</option>
                        <option>Super Lux</option>
                        <option>Ultra Super Lux</option>
                      </select>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <select class="form-select dd-select" placeholder="Area (2m)">
                        <option></option>
                        <option>80 </option>
                        <option>100 </option>
                        <option>150 </option>
                        <option>200 </option>
                      </select>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="input-group">
                        <span class="input-group-text">
                          <i class="ri-calendar-check-fill"></i>
                        </span>
                        <input type="text" class="date-input form-control" placeholder="Delivery date">
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <select class="form-select dd-select" placeholder="Furnishing Status">
                        <option></option>
                        <option>Furnished</option>
                        <option>Unfurnished</option>
                        <option>Partly Furnished</option>
                      </select>
                    </div>

                  </div>

                  <div class="row py-2">

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-1">
                        <label class="form-check-label" for="feat-1">High speed internet</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-2">
                        <label class="form-check-label" for="feat-2">Solar Cells</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-3">
                        <label class="form-check-label" for="feat-3">Club House</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-6">
                        <label class="form-check-label" for="feat-6">Spa</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-7">
                        <label class="form-check-label" for="feat-7">Massage Center</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-8">
                        <label class="form-check-label" for="feat-8">Smart home</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-9">
                        <label class="form-check-label" for="feat-9">Swimming pools</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-11">
                        <label class="form-check-label" for="feat-11">Ladies pool</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-12">
                        <label class="form-check-label" for="feat-12">Aqua park</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-13">
                        <label class="form-check-label" for="feat-13">Security 24/7</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-14">
                        <label class="form-check-label" for="feat-14">Kids area</label>
                      </div>
                    </div>

                    <div class="col-6 col-lg-3 col-sm-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="feat-16">
                        <label class="form-check-label" for="feat-16">Sandy beach</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-1 order-lg-last order-last">
              <button type="submit" class="submit-btn site-btn" title="Search">
                <i class="ri-search-line"></i>
                <span class="d-inline-block d-lg-none">Search</span>
              </button>
            </div>

          </div>

          <button type="button" data-bs-toggle="collapse" data-bs-target="#moreOptions" aria-expanded="false"
            class="more-options-btn">
          </button>

        </form>
        <div class="most-searched mt-2">
          <a href="units.html" class="badge">North coast</a>
          <a href="units.html" class="badge">New capital</a>
          <a href="units.html" class="badge">New cairo</a>
          <a href="units.html" class="badge">October</a>
          <a href="units.html" class="badge">Hurghada</a>
        </div>
      </div>
    `;
  }
};

class ProjectCard extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    const attr = (attribute) => this.getAttribute(attribute);

    this.innerHTML = /* html */`
      <div class="card-item project-card">
        <div class="card-item__content">

          <div class="card-item__header">
            <a href="projects.html" class="dev-logo">
              <img src="${attr("dev-logo") || "assets/placeholder-img.svg"}" alt="">
            </a>

            <div class="card-img">
              <img src="${attr("img")}" onerror="this.remove()" alt="">
            </div>
          </div>

          <div class="card-item__footer">
            <h4 class="card-title text-truncate" title="${attr("data-title")}">
              <a href="project.html">${attr("data-title")}</a>
            </h4>

            <address class="address" class="text-truncate">
              <i class="ri-map-pin-line"></i> ${attr("loc")}
            </address>

            <ul class="card-info">
              <li>
                <small>Area from:</small>
                <strong>${attr("area") || ""}</strong> m<sup>2</sup>
              </li>
              <li>
                <small>Starting price:</small>
                <strong>${attr("price") || ""} EGP</strong>
              </li>
              <li>
                <small>Installments:</small>
                <strong>${attr("installs") || ""}</strong> Months
              </li>
              <li class="card-tags">
                <a href="projects.html" class="tag type">${attr("tag") || ""}</a>
                <a href="projects.html" class="tag status">${attr("status") || ""}</a>
              </li>
            </ul>

          </div>

        </div>

        <div class="mt-3">
          <a class="site-btn d-block text-center stretched-link" href="project.html" target="_blank" rel="noopener"
            noreferrer>
            Read more...
          </a>
        </div>
      </div>
    `;
  }
};

class DevCard extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    const attr = (attribute) => this.getAttribute(attribute);

    this.innerHTML = /* html */`
      <div class="dev-card">
        <div class="dev-logo">
          <a href="projects.html" class="stretched-link">
            <img  src="${attr("img")}" alt="">
          </a>
        </div>
        <div class="title my-2">
          <h4 class='text-capitalize'>
            <a href="projects.html" title="${attr("data-title")}">${attr("data-title") || ""}</a>
          </h4>
        </div>
      </div>
    `;
  }
};

class UnitCard extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    const attr = (attribute) => this.getAttribute(attribute);

    this.innerHTML = /* html */`
      <div class="card-item unit-card">
        <div class="card-item__content">

          <div class="card-item__header">
            <a href="projects.html" class="dev-logo">
              <img src="${attr("dev-logo") || "assets/placeholder-img.svg"}" alt="">
            </a>

            <div class="card-img">
              <img src="${attr("img")}" onerror="this.remove()" alt="">
            </div>

            <div class="commercial-tag">
              <a href="units.html">Commercial</a>
            </div>
          </div>

          <div class="card-item__footer">
            <h4 class="card-title text-truncate" title="${attr("data-title")}">
              <a href="unit.html">${attr("data-title")}</a>
            </h4>

            <ul class="card-info">
              <li>
                <small>${attr("purpose")}</small>
                <strong>${attr("type")}</strong>
              </li>
              <li>
                <small>Price</small>
                <strong>${attr("price") || ""} EGP</strong>
              </li>
              <li class="card-tags">
                <a href="units.html" class="tag phase">Phase ${attr("Phase")}</a>
                <a href="units.html" class="tag type">${attr("tag")}</a>
              </li>
            </ul>

            <ul class="mt-2 d-flex flex-wrap gap-3">
              <li title="Bedrooms">
                <svg width="18" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M20 9.557V3h-2v2H6V3H4v6.557C2.81 10.25 2 11.525 2 13v4a1 1 0 0 0 1 1h1v4h2v-4h12v4h2v-4h1a1 1 0 0 0 1-1v-4c0-1.475-.811-2.75-2-3.443zM18 7v2h-5V7h5zM6 7h5v2H6V7zm14 9H4v-3c0-1.103.897-2 2-2h12c1.103 0 2 .897 2 2v3z">
                  </path>
                </svg>
                <strong>${attr("beds")}</strong>
              </li>

              <li title="Bathrooms">
                <svg width="18" viewBox="0 0 512 512">
                  <path fill="currentColor"
                    d="M464 280H80V100a51.258 51.258 0 0 1 15.113-36.485l.4-.4a51.691 51.691 0 0 1 58.6-10.162a79.1 79.1 0 0 0 11.778 96.627l10.951 10.951l-20.157 20.158l22.626 22.626l20.157-20.157L311.157 71.471l20.157-20.157l-22.627-22.627l-20.158 20.157l-10.951-10.951a79.086 79.086 0 0 0-100.929-8.976A83.61 83.61 0 0 0 72.887 40.485l-.4.4A83.054 83.054 0 0 0 48 100v180H16v32h32v30.7a23.95 23.95 0 0 0 1.232 7.589L79 439.589A23.969 23.969 0 0 0 101.766 456h12.9L103 496h33.333L148 456h208.1l12 40h33.4l-12-40h20.73A23.969 23.969 0 0 0 433 439.589l29.766-89.3A23.982 23.982 0 0 0 464 342.7V312h32v-32ZM188.52 60.52a47.025 47.025 0 0 1 66.431 0L265.9 71.471L199.471 137.9l-10.951-10.949a47.027 47.027 0 0 1 0-66.431ZM432 341.4L404.468 424H107.532L80 341.4V312h352Z">
                  </path>
                </svg>
                <strong>${attr("baths")}</strong>
              </li>

              <li title="Area">
                <svg width="18" viewBox="0 0 32 32">
                  <path fill="currentColor"
                    d="M27 22.142V9.858A3.992 3.992 0 1 0 22.142 5H9.858A3.992 3.992 0 1 0 5 9.858v12.284A3.992 3.992 0 1 0 9.858 27h12.284A3.992 3.992 0 1 0 27 22.142ZM26 4a2 2 0 1 1-2 2a2.002 2.002 0 0 1 2-2ZM4 6a2 2 0 1 1 2 2a2.002 2.002 0 0 1-2-2Zm2 22a2 2 0 1 1 2-2a2.002 2.002 0 0 1-2 2Zm16.142-3H9.858A3.994 3.994 0 0 0 7 22.142V9.858A3.995 3.995 0 0 0 9.858 7h12.284A3.994 3.994 0 0 0 25 9.858v12.284A3.993 3.993 0 0 0 22.142 25ZM26 28a2 2 0 1 1 2-2a2.003 2.003 0 0 1-2 2Z" />
                </svg>
                <strong>${attr("area")}</strong>m<sup>2</sup>
              </li>
            </ul>

          </div>

        </div>

        <div class="mt-3">
          <a class="site-btn d-block text-center stretched-link" href="unit.html" target="_blank" rel="noopener" noreferrer>
            Read more...
          </a>
        </div>
      </div>
    `;
  }
};

class BlogCard extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    const attr = (attribute) => this.getAttribute(attribute);

    this.innerHTML = /* html */`
    <div class='blog'>
      <div class="row g-0">
        <div class="col-sm-5">
          <a href="blog.html" class="blog__image" target="_blank" rel="noopener" noreferrer>
            <img  src="${attr("img")}" alt="">
          </a>
        </div>

        <div class="col-sm-7">
          <div class="blog__info">
            <div class="blog__content">
              <h5 class='blog-title text-capitalize'>
                <a href="blog.html" title="${attr("data-title")}" target="_blank" rel="noopener" noreferrer>
                  ${attr("data-title")}
                </a>
              </h5>
              <p>
                <span class="icon-link me-3">
                  <i class="ri-edit-2-line"></i>
                  <span class="author">${attr("author")}</span>
                </span>
                <span class="icon-link">
                  <i class="ri-message-2-line"></i>
                  <span class="msg-count">${attr("msg")}</span>
                </span>
              </p>
            </div>
            <div class="text-end">
              <a href="blog.html" class="link-primary text-decoration-underline mt-3" target="_blank" rel="noopener" noreferrer>Read more...</a>
            </div>
          </div>
        </div>
      </div>
    </div>`;
  }
};

class ChatComponent extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.innerHTML = /* html */`
      <nav class="chat-actions">
        <input type="checkbox" class="visually-hidden toggle-action-input" id="chat-input">
        <label class="toggle-action-label toggle-chat-label" for="chat-input" title='Message Us'></label>

        <div class="social-links">
          <a href="#" class="social-link messenger-link" title='Messenger' style="--delay: 0.1s" target="_blank" rel="noopener" noreferrer>
            <i class="ri-messenger-line"></i>
          </a>
          <a href="#" class="social-link whatsapp-link" title='WhatsApp' style="--delay: 0.15s" target="_blank" rel="noopener" noreferrer>
            <i class="ri-whatsapp-line"></i>
          </a>
        </div>

      </nav>
    `;
  }
};

class FloatedSocial extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.innerHTML = /* html */`
      <div class="social-media-fixed">
        <ul class="list-unstyled social-list">
          <li>
            <a href="#" title="Facebook">
              <i class="ri-facebook-line"></i>
            </a>
          </li>
          <li>
            <a href="#" title="Twitter">
              <i class="ri-twitter-line"></i>
            </a>
          </li>
          <li>
            <a href="#" title="Instagram">
              <i class="ri-instagram-line"></i>
            </a>
          </li>
          <li>
            <a href="#" title="Linkedin">
              <i class="ri-linkedin-line"></i>
            </a>
          </li>
          <li>
            <a href="#" title="Youtube">
              <i class="ri-youtube-line"></i>
            </a>
          </li>
          <li class="line"></li>
          <li class="txt">Follow US</li>
        </ul>
      </div>
    `;
  }
};

class GoTopComponent extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.innerHTML = /* html */`
      <a href="#" class="go-top-btn">
        <i class="ri-arrow-up-s-line"></i>
        <span>TOP</span>
      </a>
    `;
  }
};

class floatedContactForm extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.innerHTML = /* html */`
      <button class="show-contact-us" title="Contact us" data-bs-toggle="collapse" data-bs-target=".floated-contact-form">
        <i class="ri-mail-unread-line ri-xl"></i>
      </button>

      <div class="collapse floated-contact-form">
        <div class="form-holder">
          <div class="text-end">
            <button class="btn-close" data-bs-toggle="collapse" data-bs-target=".floated-contact-form"></button>
          </div>

          <h4 class="form-title">contact us</h4>

          <form action="">
            <div class="form-floating mb-1">
              <input type="text" class="form-control" inputmode="text" placeholder="Name">
              <label class="contact-label">Name</label>
            </div>
            <div class="form-floating mb-1">
              <input type="email" class="form-control" inputmode="email" placeholder="Email">
              <label class="contact-label">Email</label>
            </div>
            <div class="form-floating mb-1">
              <input type="text" class="form-control" inputmode="tel" placeholder="Mobile Number">
              <label class="contact-label">Mobile Number</label>
            </div>
            <div class="form-floating">
              <textarea class="form-control" inputmode="text" placeholder="Leave a message here"></textarea>
              <label class="contact-label">Leave a message here</label>
            </div>
            <div class="mt-2">
              <button type="submit" class="site-btn">Send</button>
            </div>
          </form>
        </div>
      </div>
    `;
  }
};

customElements.define('site-header', SiteHeader);
customElements.define('cookie-component', cookieComponent);
customElements.define('site-footer', SiteFooter);
customElements.define('search-box', SearchBox);
customElements.define('project-card', ProjectCard);
customElements.define('dev-card', DevCard);
customElements.define('unit-card', UnitCard);
customElements.define('blog-card', BlogCard);
customElements.define('chat-component', ChatComponent);
customElements.define('floated-social', FloatedSocial);
customElements.define('go-top-component', GoTopComponent);
customElements.define('contact-form', floatedContactForm);

//////////////////////////////////////////////////////////////////////////////////////////

// Theme Script
function loadTheme() {

  const themetoggler = document.querySelector('#theme-toggle');
  let darkModeState = false;

  // Sets localStorage state
  function setDarkModeLocalStorage(state) {
    localStorage.setItem("dark-mode", state);
  }

  function toggleDarkMode(state) {
    document.documentElement.classList.toggle("dark-mode", state);
    darkModeState = state;
  };

  // Initial setting
  toggleDarkMode(JSON.parse(localStorage.getItem("dark-mode")) || darkModeState);

  function switchListener() {
    darkModeState = !darkModeState;
    toggleDarkMode(darkModeState);
    setDarkModeLocalStorage(darkModeState);
  }

  themetoggler.addEventListener("click", switchListener);
};

loadTheme();

//////////////////////////////////////////////////////////////////////////////////////////

// Copy page link
const copyPageLink = document.querySelector('.copy-page-link');
const pageUrl = document.querySelector("span.page-url");

if (copyPageLink) {
  copyPageLink.addEventListener("click", function (e) {
    e.preventDefault();
    const url = document.location.href;

    navigator.clipboard.writeText(url).then(function () {
      pageUrl.classList.add("show");

      setTimeout(() => {
        pageUrl.classList.remove("show");
      }, 2000);
    });
  });
};

//////////////////////////////////////////////////////////////////////////////////////////

// Handle nav indicator offset
const navLinks = document.querySelectorAll(".nav-with-indicator .nav-link");
navLinks.forEach(item => {
  item.classList.contains("active") && handleIndicator(item);
});

function handleIndicator(el) {
  const navIndicator = el.closest(".nav-with-indicator").querySelector(".nav-indicator");
  navIndicator.style.width = `${el.offsetWidth}px`;
  navIndicator.style.height = `${el.offsetHeight}px`;
  navIndicator.style.top = `${el.offsetTop}px`;
  navIndicator.style.left = `${el.offsetLeft}px`;
};

document.addEventListener("click", e => {
  const target = e.target.closest(".nav-with-indicator .nav-link");
  if (!target) return;
  handleIndicator(target);
});

//////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function () {

  // COOKIE SCRIPT
  const cookieContainer = document.querySelector('.cookie-banner');
  const cookieButton = cookieContainer.querySelector('.cookie-btn');
  cookieButton.addEventListener('click', () => {
    cookieContainer.classList.remove('active');
    localStorage.setItem('cookie-displayed', 'true');
  });

  setTimeout(() => {
    if (!localStorage.getItem('cookie-displayed')) {
      cookieContainer.classList.add('active');
    }
  }, 4000);

  //////////////////////////////////////////////////////////////////////////////////////////

  // open CONTACT FORM
//   setTimeout(() => {
//     document.querySelector('.floated-contact-form').classList.add('show');
//   }, 8000);

  //////////////////////////////////////////////////////////////////////////////////////////

  // toggle grid/list view
  const viewWrapper = $(".grid-wrapper");
  $(document).on("click", ".view-btns-holder", function (e) {
    e.preventDefault();

    if (e.target.closest(".list-view-btn")) {
      $(viewWrapper).addClass("list-wrapper");
    } else if (e.target.closest(".grid-view-btn")) {
      $(viewWrapper).removeClass("list-wrapper");
    }
  });

  //////////////////////////////////////////////////////////////////////////////////////////

  // SHOW BACK TO TOP BTN & activate sticky-holder
  let scrollUp = $(".go-top-btn");
  let stickyHolder = $(".sticky-holder");
  let stickyHeader = $(".sticky-header .main-header");

  $(window).scroll(function () {
    let scrollTop = $(this).scrollTop();
    if (scrollTop > 200) {
      scrollUp.addClass("show");
      stickyHolder.addClass("scrolled");
      if ($(window).width() >= 992) {
        stickyHeader.addClass("fixed-top");
      }
    } else {
      scrollUp.removeClass("show");
      stickyHolder.removeClass("scrolled");
      stickyHeader.removeClass("fixed-top");
    }
  });

  $(scrollUp).on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, 500);
  });

  //////////////////////////////////////////////////////////////////////////////////////////

  // ANIMATE BODY ON SHOW COLLAPSE ACCORDION
  $('.accordion-collapse').on('shown.bs.collapse', function (e) {
    e.preventDefault();
    const panel = $(this).attr('id');
    $('html, body').animate({ scrollTop: $('#' + panel).offset().top - 52 }, 500);
  });

  //////////////////////////////////////////////////////////////////////////////////////////

  // SPY SCROLL
  $('.spy-links .spy-link').click(function (e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: $("#" + $(this).data("scroll")).offset().top - 69 }, 500);
  });

  $(window).scroll(function () {
    const spySection = $(".spy-section");
    spySection.each(function () {
      if ($(window).scrollTop() > $(this).offset().top - 70) {
        const sectionId = $(this).attr('id');
        $(".spy-links .spy-link").removeClass("active");
        $(`.spy-links .spy-link[data-scroll=${sectionId}]`).addClass("active");
      };
    });
  });

  //////////////////////////////////////////////////////////////////////////////////////////

  //  LOGIN PAGE ( TOGGLE LOG AND REGISTER )
  $('#registerBtn').on('click', function (e) {
    e.preventDefault();

    $('.logpage .login').hide();
    $('.logpage .register').show();
    $('html, body').animate({ scrollTop: 0 }, 500);
  });

  $('#logBtn').on('click', function (e) {
    e.preventDefault();

    $('.logpage .login').show();
    $('.logpage .register').hide();
    $('html, body').animate({ scrollTop: 0 }, 500);
  });

  //////////////////////////////////////////////////////////////////////////////////////////

  // SWITCH LANGUAGE
  // const langBtn = $('.lang-btn');
  // langBtn.on('click', function (e) {
  //   e.preventDefault();

  //   $(this).toggleClass('x-js');
  //   if ($(this).hasClass('x-js')) {
  //     $(this).find("span").text('English');
  //     $('link[href="css/bootstrap.min.css"]').attr('href', 'css/bootstrap-rtl.min.css');
  //     $("html").attr("dir", "rtl");
  //   } else {
  //     $(this).find("span").text('العربيه');
  //     $('link[href="css/bootstrap-rtl.min.css"]').attr('href', 'css/bootstrap.min.css');
  //     $("html").attr("dir", "ltr");
  //   }
  // });

});
