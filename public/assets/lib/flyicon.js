async function flyHander() {
  console.log('fly ready');
  let timeoutSleep = 0;
  if (typeof pSleepMinutes !== 'undefined') {
    timeoutSleep = pSleepMinutes;
  }
  pUrls = localStorage.getItem('flyUrls' + pAffiliateId);
  if (pUrls) {
    timeoutSleep = pDelayMinutes;
  }

  setTimeout(
    async () => {
      console.log('fly start');
      let ONE_MINUTE = 60 * 1000;
      let ONE_HOUR = ONE_MINUTE * 60;
      let screenSize = window.innerWidth;
      let pWidth = 0;
      let pIncludeCloseDevice = true;
      if (screenSize >= 768) {
        pWidth = pWidthPCScreen;
        pIncludeCloseDevice = pIncludeClose;
      } else {
        pWidth = pWidthMobileScreen;
        if (typeof pIncludeCloseMobile != 'undefined') {
          pIncludeCloseDevice = pIncludeCloseMobile;
        }
      }

      let pUrls = [];
      let pBanners = [];

      if (pAffiliateId == 'KT20250026') {
        pBanners = ['https://static.masothue.com/images/san-deal.png'];
      }
      z;
      if (typeof iconFollowLink !== 'undefined' && iconFollowLink == true) {
        pBannerIndex = pGetLog('pUrlIndex') != undefined ? parseInt(pGetLog('pUrlIndex')) + 1 : 0;
        if (pBannerIndex >= pBanners.length) {
          pBannerIndex = 0;
        }
      } else {
        pBannerIndex = Math.floor(Math.random() * pBanners.length);
      }

      let iconP = 50;

      if (typeof iconPosition !== 'undefined') {
        iconP = iconPosition;
      }

      await getUrls();

      let rightMargin = '';
      if (typeof iconXAxis != 'undefined' && iconXAxis == 'left') {
        rightMargin += `100% - ${pWidthMobileScreen}px - 8px`;
      } else {
        rightMargin += '8px';
      }

      let popupHTML = `
        <div id="pvoucher-live-container" style="position: fixed; top: ${iconP}%; right: calc(${rightMargin}); transform: translateY(-50%)">
                <div class="position: relative;">
                    <div id="pvoucher-live-close" style="position: absolute; top: -20px; right: 0; background-color: #ffffff; border: 1px solid #bbbbbb; width: fit-content; display: inline; border-radius: 50%; padding: 3px 6px; font-size: 12px; font-weight: 600; cursor: pointer; line-height: initial;">
                        &#10006;
                    </div>
                    <div id="pvoucher-live-icon" style="width: ${pWidth}px; cursor: pointer;">
                        <img src="${pBanners[pBannerIndex]}" alt="" style="width: 100%;">
                    </div>
                </div>
            </div>
        `;

      let timeNow = new Date().getTime();
      let preEndLifeCircleTime = pGetLog('pEndLifeCircleTime');

      if (preEndLifeCircleTime != undefined) {
        if (await isRestDone(timeNow, preEndLifeCircleTime)) {
          document.body.insertAdjacentHTML('beforeend', popupHTML);
        }
      } else {
        document.body.insertAdjacentHTML('beforeend', popupHTML);
      }

      if (document.querySelector('#pvoucher-live-icon') != null) {
        document.querySelector('#pvoucher-live-icon').addEventListener('click', () => {
          handlePopupProcess();
        });
      }

      function pSetLog(name, value) {
        localStorage.setItem(name, value);
      }

      function pGetLog(name) {
        return localStorage.getItem(name);
      }

      function isRestDone(timeNow, preEndLifeCircleTime) {
        return timeNow - preEndLifeCircleTime > pLoopTimeHours * ONE_HOUR;
      }

      function isLastIndex(index) {
        return index == pUrls.length - 1;
      }

      function pHiddenContainer() {
        document.querySelector('#pvoucher-live-container').style.display = 'none';
      }

      async function handleOpenTab(timeNow, pClose) {
        let pPreIndex = pGetLog('pUrlIndex');
        let pIndex = 0;

        if (typeof iconFollowLink !== 'undefined' && iconFollowLink == true) {
          if (getBannerIndex() != pPreIndex) {
            pIndex = parseInt(pPreIndex) + 1;
          } else {
            pIndex = parseInt(pPreIndex);
          }
        } else {
          pIndex = parseInt(pPreIndex) + 1;
        }

        if (pIndex >= pUrls.length) {
          pIndex = 0;
        }

        if (await isLastIndex(pIndex)) {
          pSetLog('pEndLifeCircleTime', timeNow);
          pHiddenContainer();
        }

        pSetLog('pUrlIndex', pIndex);
        pIncludeCloseDevice = false;
        // window.open(pDeeplink(pUrls[pIndex]), "_blank", 'noopener');
        window.open(pUrls[pIndex], '_blank', 'noopener');
      }

      if (document.querySelector('#pvoucher-live-close') != null) {
        document.querySelector('#pvoucher-live-close').addEventListener('click', () => {
          if (pIncludeCloseDevice) {
            handlePopupProcess(true);
          } else {
            pHiddenContainer();
          }
        });
      }

      async function handlePopupProcess(pClose = false) {
        let timeNow = new Date().getTime();
        let preEndLifeCircleTime = pGetLog('pEndLifeCircleTime');
        let pUrlIndex = pGetLog('pUrlIndex');

        if (pUrlIndex != undefined) {
          if (preEndLifeCircleTime != undefined) {
            if (await isRestDone(timeNow, preEndLifeCircleTime)) {
              handleOpenTab(timeNow, pClose);
            } else {
              if (pClose) {
                pHiddenContainer();
              }
            }
          } else {
            handleOpenTab(timeNow, pClose);
          }
        } else {
          if (await isLastIndex(0)) {
            pSetLog('pEndLifeCircleTime', timeNow);
            pHiddenContainer();
          }

          pIncludeCloseDevice = false;
          pSetLog('pUrlIndex', 0);
          window.open(pUrls[0], '_blank', 'noopener');
        }
      }

      function getBannerIndex() {
        let bannerUrl = document.querySelector('#pvoucher-live-icon img').src;

        let bannerIndex = pBanners.indexOf(bannerUrl);

        return bannerIndex;
      }

      const el = document.getElementById('pvoucher-live-icon');
      if (el != null) {
        function swingEaseOut(callback) {
          let frame = 0;
          const totalFrames = 60;
          const swings = 2;
          const amplitude = 15;

          function animate() {
            const t = frame / totalFrames;
            const damping = 1 - t;

            const angle = Math.sin(t * swings * 2 * Math.PI) * amplitude * damping;
            el.style.transform = `rotate(${angle}deg)`;

            frame++;
            if (frame <= totalFrames) {
              requestAnimationFrame(animate);
            } else {
              el.style.transform = 'rotate(0deg)';
              if (callback) callback();
            }
          }

          animate();
        }

        function loopWithPause() {
          swingEaseOut(() => {
            setTimeout(loopWithPause, 1000);
          });
        }

        loopWithPause();
      }

      async function getUrls() {
        flyUrls = flyGetLog('flyUrls' + pAffiliateId);
        flyUrlsLoadTime = flyGetLog('flyUrlsLoadTime');
        if (!flyUrls || flyUrls.length == 0 || !flyUrlsLoadTime || Date.now() - flyUrlsLoadTime >= 60 * ONE_MINUTE) {
          const token = 'MTcxNjY5NjAwMDBfVDdFUFBVSzJNNFVGTTZITU1UV1dQVEVVRUk3T0tQT1M';
          const response = await fetch(
            `https://tkglobal.asia/api/common/get-urls-by-id?token=${token}&affId=${pAffiliateId}`
          );
          const json = await response.json();
          if (json.status === 'success') {
            flyUrls = json.response;
            flySetLog('flyUrls' + pAffiliateId, JSON.stringify(flyUrls));
            flySetLog('flyUrlsLoadTime', Date.now());
            pUrls = flyUrls;
          }
        } else {
          flyUrls = JSON.parse(flyUrls);
          pUrls = flyUrls;
        }
      }

      function flySetLog(name, value) {
        localStorage.setItem(name, value);
      }

      function flyGetLog(name) {
        return localStorage.getItem(name);
      }
    },
    timeoutSleep * 60 * 1000
  );
}

const screenSize = window.innerWidth;
// window.addEventListener("load", () => {
document.addEventListener('DOMContentLoaded', async () => {
  if (screenSize >= 768) {
    return false;
  }
  flyHander();
});
