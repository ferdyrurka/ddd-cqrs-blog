import {NgModule} from '@angular/core';
import {SingleSidebarLayoutComponent} from './single-sidebar-layout/single-sidebar-layout.component';
import {SharedRoutingModule} from './shared-routing.module';

@NgModule({
  exports: [
    SingleSidebarLayoutComponent,
  ],
  declarations: [
    SingleSidebarLayoutComponent,
  ],
  imports: [
    SharedRoutingModule,
  ]
})
export class SharedModule { }
