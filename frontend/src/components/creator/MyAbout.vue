<template>
  <div class="layout">
    <div class="describe date">
      <div class="description">
        <div class="title">Description</div>
        <div class="info">
          <div class="item">→ ប៉ាវបាយព្រឹក Admin តាមរយះ</div>
          <div class="item">►ABA → 004 848 555</div>
          <div class="item">►ACLEDA → 0967410982</div>
          <div class="item">►Wng → 05800908</div>
          <div class="item">ឈ្មោះ ( CHHEAV NARIN )</div>
        </div>
      </div>
      <div class="stats">
        <div class="title">Stats</div>
        <div class="info">
          <div class="item">Location: United States</div>
          <div class="links">
            <a href="https://www.youtube.com/channel/...">
              <i class="fab fa-youtube"></i>
            </a>
            <a href="https://www.facebook.com/...">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="https://www.instagram.com/...">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
          <div class="item">Joined 21 Jan 2023</div>
          <div class="item">410,792 views</div>
        </div>
      </div>
    </div>
    <div class="contact">
      <div class="title">Contact</div>
      <div class="text">
        Contact me via the above telegram or send an email to
        narinchheav8888.kh@gmail.com. Please don't give a copyright strike to my
        channel. Instead please ask me to remove your movie clips, I will remove
        them immediately or you can raise a copyright claim to get the
        advertisement revenue. I am satisfied to give the revenue to you.
      </div>
    </div>
    <div class="welcome">
      <div class="title">Welcome</div>
      <div class="text">
        សូមស្វាគមន៍អ្នកទាំងអស់គ្នា មកកាន់ឆានែល Q-Bii Animations
        សូមអ្នកទាំងអស់គ្នាជួយចុច Subscribe និងរូប កន្តិង ដើម្បីទទួលបាននូវ
        វីដេអូដម្រាយលម្អិតរឿងថ្មីៗ និងល្អៗមើលជាច្រើនផងដែរ។ Welcome to the Q-Bii
        Channel, please click Subscribe and the bell to get more detailed
        videos, new stories and good to watch.
      </div>
    </div>
    <div class="disclaimer">
      <div class="title">Disclaimer</div>
      <div class="text">
        I do not own any videos and images in this video, nor intend to steal
        the owner's copyrighted materials. I or this channel does not claim any
        right over them. I just edited and published it to the audience for
        entertainment purposes only.
      </div>
    </div>
    <div class="details">
      <div class="title">Details</div>
      <div class="info">
        <div class="item">Location: United States</div>
        <div class="links">
          <div class="item"><a href="https://www.youtube.com/channel/...">YouTube</a></div>
          <div class="item"><a href="https://www.facebook.com/...">Facebook</a></div>
          <div class="item"><a href="https://www.instagram.com/...">Instagram</a></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Layout",
};
</script>

<style>
.layout {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
  padding: 20px;
}

.describe,
.stats,
.disclaimer,
.contact,
.welcome,
.details {
  width: 100%;
  margin-bottom: 20px;
  background-color: #fff;
  padding: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.describe .title,
.stats .title,
.disclaimer .title,
.contact .title,
.welcome .title,
.details .title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.describe .info,
.stats .info,
.disclaimer .text,
.contact .text,
.welcome .text,
.details .info {
  font-size: 16px;
  line-height: 1.5;
}

.describe .item,
.stats .item,
.details .item {
  margin-bottom: 5px;
}

.describe .item::before,
.stats .item::before,
.details .item::before {
  content: "•";
  margin-right: 5px;
}

.describe .item:first-child,
.stats .item:first-child,
.details .item:first-child {
  margin-top: 10px;
}

.stats .links a {
  display: inline-block;
  margin-right: 10px;
  color: #555;
  transition: color 0.3s ease-in-out;
}

.stats .links a:hover {
  color: #007bff;
}

.stats .links a i {
  font-size: 24px;
}

.contact .text a {
  color: #007bff;
}

.contact .text a:hover {
  text-decoration: underline;
}

@media (min-width: 768px) {
  .layout {
    flex-direction: row;
    justify-content: space-between;
  }

  .describe,
  .stats,
  .disclaimer,
  .contact,
  .welcome,
  .details {
    width: calc(50% - 10px);
  }
}
</style>