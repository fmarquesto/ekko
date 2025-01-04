<template>
  <div id="app">
    <h1>Infinite Scroll - Load Images</h1>
    <div class="image-container">
      <!-- Loop through the rows of images and display them -->
      <div
          class="image-row"
          v-for="(imageRow, rowIndex) in imageRows"
          :key="rowIndex"
      >
        <!-- Loop through the images in the current row -->
        <div
            class="image"
            v-for="(image, index) in imageRow"
            :key="index"
        >
          <img :src="image" alt="Image" />
        </div>
      </div>
    </div>

    <div v-if="loading" class="loading">
      <p>Loading more images...</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      imageRows: [],       // Array to store rows of images
      loading: false,      // Flag to show loading indicator
      page: 1,             // Track the current page for API calls
    };
  },
  mounted() {
    // Load initial set of images
    this.loadImages();

    // Add event listener for scrolling
    window.addEventListener("scroll", this.handleScroll);
  },
  beforeDestroy() {
    // Remove event listener when the component is destroyed
    window.removeEventListener("scroll", this.handleScroll);
  },
  methods: {
    async loadImages() {
      this.loading = true;
      try {
        const response = await axios.get(`/images/${this.page}`);
        console.log(response.data);

        // Group the images into rows
        this.imageRows.push(response.data);
      } catch (error) {
        console.error("Error fetching images:", error);
      } finally {
        this.loading = false;
      }
    },

    handleScroll() {
      // Calculate how far the user has scrolled
      const scrollPosition = window.scrollY + window.innerHeight;
      const threshold = document.documentElement.scrollHeight * 0.75; // 75% of page height

      if (scrollPosition >= threshold && !this.loading) {
        // Load next page of images if the scroll reaches 75% of the page
        this.page += 1;
        this.loadImages();
      }
    },
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.image-container {
  display: flex;
  flex-direction: column;
  gap: 20px;
  padding: 20px;
}

.image-row {
  display: flex;
  justify-content: center;
  gap: 20px; /* Add space between columns */
}

.image {
  width: 100%;
  flex: 1; /* Ensure the images take up equal space within the row */
}

.image img {
  width: 100%;
  height: auto;
  border-radius: 10px;
}

.loading {
  margin: 20px;
}
</style>
