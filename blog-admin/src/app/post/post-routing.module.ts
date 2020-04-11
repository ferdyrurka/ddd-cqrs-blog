import {NgModule} from '@angular/core';
import {RouterModule} from '@angular/router';
import {RightSidebarComponent} from './page/create/right-sidebar/right-sidebar.component';
import {MainContentComponent} from './page/create/main-content/main-content.component';
import {SingleSidebarLayoutComponent} from '../shared/single-sidebar-layout/single-sidebar-layout.component';

const routes = [
  {
    path: 'post',
    component: SingleSidebarLayoutComponent,
    children: [
      {
        path: 'create',
        children: [
          { path: '', component: MainContentComponent, outlet: 'main-content' },
          { path: '', component: RightSidebarComponent, outlet: 'right-sidebar' },
        ]
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class PostRoutingModule { }
