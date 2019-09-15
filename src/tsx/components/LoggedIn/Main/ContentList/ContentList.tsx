/** @jsx jsx */
import { jsx, css } from '@emotion/core';
import { Fragment, useEffect } from 'react';
import { Redirect } from 'react-router-dom';

import ContentListTable from './ContentListTable';

import Title from '../../../../template/Title';
import Button from '../../../../template/Button';
import { newContentRegistrationPage, contentListPage, TOP_PAGE_PATH } from '../../../../data/pages';
import { Table, THead, TRow, TH } from '../../../../template/Table';

type ContentListProps = {
  permission: Permission;
  windowHeight: number;
};

const columnWidthPropotions = ['10%', '20%', '30%', '20%', '10%', '10%'];

const ContentList = ({ permission, windowHeight }: ContentListProps): JSX.Element => {
  useEffect(() => {
    document.title = contentListPage.pageName;
  }, []);
  return (
    <Fragment>
      <div
        css={css`
          display: flex;
          align-items: center;
        `}
      >
        <Title value={contentListPage.pageName} additionalStyle={permission.editor ? { float: 'left' } : undefined} />
        {permission.editor ? (
          <Button
            as="routerLink"
            to={newContentRegistrationPage.path}
            value="New Registration"
            additionalStyle={{
              backgroundColor: '#e87c00',
              width: '15rem',
              margin: '0 0 0 auto',
            }}
          />
        ) : null}
      </div>
      <Table>
        <THead>
          <TRow>
            <TH width={columnWidthPropotions[0]}>ID</TH>
            <TH width={columnWidthPropotions[1]}>Category</TH>
            <TH width={columnWidthPropotions[2]}>Title</TH>
            <TH width={columnWidthPropotions[3]}>Registration Date</TH>
          </TRow>
        </THead>
        <ContentListTable windowHeight={windowHeight} columnWidthPropotions={columnWidthPropotions} />
      </Table>
      {permission.editor || permission.viewer ? null : <Redirect to={TOP_PAGE_PATH} />}
    </Fragment>
  );
};

export default ContentList;