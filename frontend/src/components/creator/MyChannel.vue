<template>
  <div class="my-channels">
    <h2>Channels</h2>
    <div class="channel-list">
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-m.jpg" alt="Channel 1" />
        </div>
        <div class="channel-info">
          <div class="channel-name">Q-Bii Studio</div>
          <div class="subscriber-count">30.8K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-w.jpg" alt="Channel 2" />
        </div>
        <div class="channel-info">
          <div class="channel-name">KH Drama</div>
          <div class="subscriber-count">1.89K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-m.jpg" alt="Channel 1" />
        </div>
        <div class="channel-info">
          <div class="channel-name">Q-Bii Studio</div>
          <div class="subscriber-count">30.8K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-w.jpg" alt="Channel 2" />
        </div>
        <div class="channel-info">
          <div class="channel-name">KH Drama</div>
          <div class="subscriber-count">1.89K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-m.jpg" alt="Channel 1" />
        </div>
        <div class="channel-info">
          <div class="channel-name">Q-Bii Studio</div>
          <div class="subscriber-count">30.8K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-w.jpg" alt="Channel 2" />
        </div>
        <div class="channel-info">
          <div class="channel-name">KH Drama</div>
          <div class="subscriber-count">1.89K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-m.jpg" alt="Channel 1" />
        </div>
        <div class="channel-info">
          <div class="channel-name">Q-Bii Studio</div>
          <div class="subscriber-count">30.8K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-w.jpg" alt="Channel 2" />
        </div>
        <div class="channel-info">
          <div class="channel-name">KH Drama</div>
          <div class="subscriber-count">1.89K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-m.jpg" alt="Channel 1" />
        </div>
        <div class="channel-info">
          <div class="channel-name">Q-Bii Studio</div>
          <div class="subscriber-count">30.8K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-w.jpg" alt="Channel 2" />
        </div>
        <div class="channel-info">
          <div class="channel-name">KH Drama</div>
          <div class="subscriber-count">1.89K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-m.jpg" alt="Channel 1" />
        </div>
        <div class="channel-info">
          <div class="channel-name">Q-Bii Studio</div>
          <div class="subscriber-count">30.8K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <div class="channel">
        <div class="profile-image">
          <img src="../../assets/pare-w.jpg" alt="Channel 2" />
        </div>
        <div class="channel-info">
          <div class="channel-name">KH Drama</div>
          <div class="subscriber-count">1.89K subscribers</div>
          <button class="subscribe-button">Subscribe</button>
        </div>
      </div>
      <!-- More channels... -->
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    subscribe(index) {
      const channel = this.channels[index];
      alert(`You have subscribed to ${channel.name}!`);
    },
  },
};
</script>

<style scoped>
.channel-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

h2 {
  margin-left: 10%;
}

.channel {
  display: flex;
  flex-direction: column;
  width: calc(20% - 16px);
  margin-right: 20px;
  margin-bottom: 20px;
  margin-top: 2%;
}

.profile-image img {
  width: 50%;
  height: auto;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 10px;
}

.channel-name {
  font-weight: bold;
  margin-bottom: 5px;
}

.subscriber-count {
  margin-bottom: 5px;
}

.subscribe-button {
  background-color: #0077FF;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 5px 10px;
  cursor: pointer;
}

.subscribe-button:hover {
  background-color: #0055DD;
}
</style>
