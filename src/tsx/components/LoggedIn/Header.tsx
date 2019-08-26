/** @jsx jsx */
import { jsx, css } from '@emotion/core'

type HeaderProps = {
  loginUser: string;
  authority: string;
}

const wrapper = css`
  align-items: center;
  background-color: #555;
  display: flex;
  flex-shrink: 0;
  height: 6.0rem;
  justify-content: space-between;
  padding: 0 3.0rem;
`;

const siteName = css`
  color: #fff;
  font-size: 2.5rem;
  margin: 0px;
`;

const rightItem = css`
  align-items: center;
  display: flex;
`;

const user = css`
  color: #fff;
  font-size: 1.5rem;
`;

const logoutAnchor = css`
  align-items: center;
  color: #ddd;
  display: flex;
  font-size: 1.8rem;
  margin: 0 0 0 2.0rem;
`;

const logoutImage = css`
  display: block;
  fill: white !important;
  height: 1.8rem;
  margin-right: 0.7rem;
  transform: rotate(180deg);
  width: 1.8rem;
`;

const Header = ({ loginUser, authority }: HeaderProps): JSX.Element => {
  return(
    <header css={wrapper}>
      <p css={siteName}>CMS</p>
      <div css={rightItem}>
        <p css={user}>{loginUser}でログイン中（{authority}）</p>
        <a css={logoutAnchor} href="logoutProcess.php">
          <svg css={logoutImage} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 570 487.88">
            <title>logout</title><polygon points="154.48 349.66 99.43 276.61 362.26 276.61 362.26 212.83 99.43 212.83 154.48 139.78 79.09 139.78 0 244.72 79.09 349.66 154.48 349.66"/><path d="M379,643.94a78.27,78.27,0,0,1-78.18-78.18V504.65h61.78v61.11a16.62,16.62,0,0,0,16.4,16.4H606.82a16.62,16.62,0,0,0,16.4-16.4V234.24a16.62,16.62,0,0,0-16.4-16.4H379a16.62,16.62,0,0,0-16.4,16.4v61H300.8v-61A78.27,78.27,0,0,1,379,156.06H606.82A78.27,78.27,0,0,1,685,234.24V565.76a78.27,78.27,0,0,1-78.18,78.18Z" transform="translate(-115 -156.06)"/>
          </svg>
          Logout
        </a>
      </div>
    </header>
  );
}

export default Header;