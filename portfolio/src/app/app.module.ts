import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms'
import { BrowserModule } from '@angular/platform-browser';
import {HttpClientModule} from "@angular/common/http";
import { ReactiveFormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FooterComponent } from './components/footer/footer.component';
import { AboutComponent } from './components/about/about.component';
import { NavigationMenuComponent } from './components/navigation-menu/navigation-menu.component';
import { SkillComponent } from './components/skill/skill.component';
import { ProjectComponent } from './components/project/project.component';
import { HomeComponent } from './pages/home/home.component';
import { ProjectContentComponent } from './pages/project-content/project-content.component';
import { ContactComponent } from './components/contact/contact.component';
import { PageNotFoundComponent } from './pages/page-not-found/page-not-found.component';

import { YouTubePlayerModule } from '@angular/youtube-player';
import { CoverPhotoComponent } from './components/coverphoto/coverphoto.component';
import { MyYoutubePlayerComponent } from './components/my-youtube-player/my-youtube-player.component';
import { UrlImagePipe } from './pipes/url-image.pipe';


@NgModule({
  declarations: [
    AppComponent,
    FooterComponent,
    AboutComponent,
    NavigationMenuComponent,
    SkillComponent,
    ProjectComponent,
    HomeComponent,
    ProjectContentComponent,
    ContactComponent,
    PageNotFoundComponent,
    CoverPhotoComponent,
    MyYoutubePlayerComponent,
    UrlImagePipe
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    YouTubePlayerModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
