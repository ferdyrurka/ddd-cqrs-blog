import {NgModule} from '@angular/core';
import {PostRoutingModule} from './post-routing.module';
import {ContentComponent} from './component/content/content.component';
import {MetadataComponent} from './component/metadata/metadata.component';
import {PublishComponent} from './component/publish/publish.component';
import { RightSidebarComponent } from './page/create/right-sidebar/right-sidebar.component';
import { MainContentComponent } from './page/create/main-content/main-content.component';

@NgModule({
  declarations: [
    ContentComponent,
    MetadataComponent,
    PublishComponent,
    RightSidebarComponent,
    MainContentComponent,
  ],
  imports: [
    PostRoutingModule
  ]
})
export class PostModule { }
