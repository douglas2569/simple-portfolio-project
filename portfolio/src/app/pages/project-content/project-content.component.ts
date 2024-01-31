import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router} from '@angular/router';
import Project from '../../models/Project';
import { ProjectService } from '../../services/project.service';

@Component({
  selector: 'app-project-content',
  templateUrl: './project-content.component.html',
  styleUrls: ['./project-content.component.css'],
})

export class ProjectContentComponent implements OnInit {
  project!:Project
  apiLoaded:boolean = false

  constructor(private route:ActivatedRoute, private projectService:ProjectService) { }

  ngOnInit(): void {
    const id =  this.route.snapshot.paramMap.get('id')
    this.mount(id)
    this.apiYoutubeLoaded()

    window.scroll(0,0)
  }

  mount(projectId:string|null):void{

    this.projectService.getProject(projectId).subscribe((response)=>{
      this.project = response.data
      console.log(this.project )
    })

  }

  apiYoutubeLoaded():void{
    if (!this.apiLoaded) {
      const tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      document.body.appendChild(tag);
      this.apiLoaded = true;
    }
  }

}
